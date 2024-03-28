<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOfRawMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class PurchaseReportController extends Controller
{
  /**
   * menampilkan halaman purchase report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])->whereYear('purchase_date', $request->year)
          ->whereMonth('purchase_date', $request->month)
          ->orderBy('purchase_date', 'desc');
      } else if ($request->year != '') {
        $query = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])->whereYear('purchase_date', $request->year)
          ->orderBy('purchase_date', 'desc');
      } else {
        $query = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])->orderBy('purchase_date', 'desc');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.purchase.purchase_report', compact('transaction'));
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
      $purchase = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])
        ->whereYear('purchase_date', $request->year)
        ->whereMonth('purchase_date', $request->month)
        ->orderBy('purchase_date', 'desc')
        ->get();

      $month = indonesianMonth($request->month);
      $year = $request->year;
      $title = 'Laporan Pembelian Bahan Bulan ' . $month . ' Tahun ' . $year;
      $total = PurchaseOfRawMaterial::whereYear('purchase_date', $request->year)
        ->whereMonth('purchase_date', $request->month)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.purchase.report_purchase', compact(['title', 'dateNow', 'total', 'purchase', 'month', 'year']));

      return $pdf->stream('laporan_pembelian_bahan_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $purchase = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])
        ->whereYear('purchase_date', $request->year)
        ->orderBy('purchase_date', 'desc')
        ->get();

      $year = $request->year;
      $title = 'Laporan Pembelian Bahan Tahun ' . $year;
      $total = PurchaseOfRawMaterial::whereYear('purchase_date', $request->year)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.purchase.report_purchase', compact(['title', 'dateNow', 'total', 'purchase', 'year']));

      return $pdf->stream('laporan_pembelian_bahan_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $purchase = PurchaseOfRawMaterial::with(['raw_material', 'supplier'])
        ->orderBy('purchase_date', 'desc')
        ->get();

      $title = 'Laporan Pembelian Bahan';
      $total = PurchaseOfRawMaterial::sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.purchase.report_purchase', compact(['title', 'dateNow', 'total', 'purchase']));

      return $pdf->stream('laporan_pembelian_bahan' . random_int(0000, 9999) . ".pdf");
    }
  }
}
