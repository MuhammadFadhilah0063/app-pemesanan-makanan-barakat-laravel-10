<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class SaleReportController extends Controller
{
  /**
   * menampilkan halaman sale report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = Sale::whereYear('sale_date', $request->year)
          ->whereMonth('sale_date', $request->month)
          ->orderBy('sale_date', 'desc');
      } else if ($request->year != '') {
        $query = Sale::whereYear('sale_date', $request->year)
          ->orderBy('sale_date', 'desc');
      } else {
        $query = Sale::orderBy('sale_date', 'desc');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.sale.sale_report', compact('transaction'));
  }

  /**
   * @return report pdf
   */
  public function export(Request $request)
  {
    Date::setLocale('id');
    $dateNow = Carbon::now()->translatedFormat('l, d F Y');

    if ($request->year != '' && $request->month != '') {

      // Cetak berdasarkan tahun dan bulan
      $sale = Sale::whereYear('sale_date', $request->year)
        ->whereMonth('sale_date', $request->month)
        ->orderBy('sale_date', 'desc')
        ->get();

      $month = indonesianMonth($request->month);
      $year = $request->year;
      $title = 'Laporan Penjualan Bulan ' . $month . ' Tahun ' . $year;
      $totalRevenue = Sale::whereYear('sale_date', $request->year)
        ->whereMonth('sale_date', $request->month)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.sale.report_sale', compact(['title', 'dateNow', 'totalRevenue', 'sale', 'month', 'year']));

      return $pdf->stream('laporan_penjualan_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $sale = Sale::whereYear('sale_date', $request->year)
        ->orderBy('sale_date', 'desc')
        ->get();

      $year = $request->year;
      $title = 'Laporan Penjualan Tahun ' . $year;
      $totalRevenue = Sale::whereYear('sale_date', $request->year)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.sale.report_sale', compact(['title', 'dateNow', 'totalRevenue', 'sale', 'year']));

      return $pdf->stream('laporan_penjualan_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $sale = Sale::orderBy('sale_date', 'desc')->get();
      $title = 'Laporan Penjualan';
      $totalRevenue = Sale::sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.sale.report_sale', compact(['title', 'dateNow', 'totalRevenue', 'sale']));

      return $pdf->stream('laporan_penjualan' . random_int(0000, 9999) . ".pdf");
    }
  }
}
