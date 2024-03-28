<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\OnlineOrder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class OnlineOrderReportController extends Controller
{
  /**
   * menampilkan halaman online order report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = OnlineOrder::whereYear('pick_up_date', $request->year)
          ->whereMonth('pick_up_date', $request->month)
          ->orderBy('pick_up_date', 'DESC')
          ->orderBy('pick_up_time', 'DESC');
      } else if ($request->year != '') {
        $query = OnlineOrder::whereYear('pick_up_date', $request->year)
          ->orderBy('pick_up_date', 'DESC')
          ->orderBy('pick_up_time', 'DESC');
      } else {
        $query = OnlineOrder::orderBy('pick_up_date', 'DESC')
          ->orderBy('pick_up_time', 'DESC');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('order_status', 'components.data-tables.order_status')
        ->rawColumns(['order_status'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.online-order.online_order_report', compact('transaction'));
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
      $order = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->orderBy('pick_up_date', 'DESC')
        ->orderBy('pick_up_time', 'DESC')
        ->get();
      $totalRevenue = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->sum('total');

      $month = indonesianMonth($request->month);
      $year = $request->year;

      $pending = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->where('status', 'pending')
        ->count();
      $process = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->where('status', 'process')
        ->count();
      $success = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->where('status', 'success')
        ->count();
      $failed = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->whereMonth('pick_up_date', $request->month)
        ->where('status', 'failed')
        ->count();

      $title = 'Laporan Pesanan Online Bulan ' . $month . ' Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-order.report_online_order',
          compact(['title', 'dateNow', 'order', 'month', 'year', 'totalRevenue', 'pending', 'process', 'success', 'failed'])
        );

      return $pdf->stream('laporan_pesanan_online_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $order = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->orderBy('pick_up_date', 'DESC')
        ->orderBy('pick_up_time', 'DESC')
        ->get();
      $totalRevenue = OnlineOrder::whereYear('pick_up_date', $request->year)->sum('total');

      $year = $request->year;

      $pending = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->where('status', 'pending')
        ->count();
      $process = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->where('status', 'process')
        ->count();
      $success = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->where('status', 'success')
        ->count();
      $failed = OnlineOrder::whereYear('pick_up_date', $request->year)
        ->where('status', 'failed')
        ->count();

      $title = 'Laporan Pesanan Online Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-order.report_online_order',
          compact(['title', 'dateNow', 'order', 'year', 'totalRevenue', 'pending', 'process', 'success', 'failed'])
        );

      return $pdf->stream('laporan_pesanan_online_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $order = OnlineOrder::orderBy('pick_up_date', 'DESC')
        ->orderBy('pick_up_time', 'DESC')
        ->get();
      $totalRevenue = OnlineOrder::sum('total');
      $pending = OnlineOrder::where('status', 'pending')->count();
      $process = OnlineOrder::where('status', 'process')->count();
      $success = OnlineOrder::where('status', 'success')->count();
      $failed = OnlineOrder::where('status', 'failed')->count();
      $title = 'Laporan Pesanan Online';

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-order.report_online_order',
          compact(['title', 'dateNow', 'order', 'totalRevenue', 'pending', 'process', 'success', 'failed'])
        );

      return $pdf->stream('laporan_pesanan_online' . random_int(0000, 9999) . ".pdf");
    }
  }
}
