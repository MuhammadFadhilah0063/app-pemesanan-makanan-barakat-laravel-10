<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class PaymentReportController extends Controller
{
  /**
   * menampilkan halaman payment report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = Payment::with(['order', 'offline_order'])
          ->whereYear('created_at', $request->year)
          ->whereMonth('created_at', $request->month)
          ->orderBy('created_at', 'desc');
      } else if ($request->year != '') {
        $query = Payment::with(['order', 'offline_order'])
          ->whereYear('created_at', $request->year)
          ->orderBy('created_at', 'desc');
      } else {
        $query = Payment::with(['order', 'offline_order'])
          ->orderBy('created_at', 'desc');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('payment_status', 'components.data-tables.report-payment.payment_status')
        ->addColumn('name', 'components.data-tables.report-payment.name_order')
        ->addColumn('total', 'components.data-tables.report-payment.total_order')
        ->addColumn('order', 'components.data-tables.report-payment.order')
        ->rawColumns(['payment_status', 'name', 'total', 'order'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.payment.payment_report', compact('transaction'));
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
      $payment = Payment::with(['order', 'offline_order'])
        ->whereYear('created_at', $request->year)
        ->whereMonth('created_at', $request->month)
        ->orderBy('created_at', 'desc')
        ->get();

      $totalRevenue = Payment::whereHas('order')
        ->whereYear('created_at', $request->year)
        ->whereMonth('created_at', $request->month)
        ->withSum('order', 'total')
        ->get()
        ->sum('order_sum_total')
        +
        Payment::whereHas('offline_order')
        ->whereYear('created_at', $request->year)
        ->whereMonth('created_at', $request->month)
        ->withSum('offline_order', 'total')
        ->get()
        ->sum('offline_order_sum_total');

      $month = indonesianMonth($request->month);
      $year = $request->year;

      $pending = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'pending')
        ->whereMonth('created_at', $request->month)
        ->count();
      $expired = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'expired')
        ->whereMonth('created_at', $request->month)
        ->count();
      $failed = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'failed')
        ->whereMonth('created_at', $request->month)
        ->count();
      $success = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'success')
        ->whereMonth('created_at', $request->month)
        ->count();
      $title = 'Laporan Pembayaran Bulan ' . $month . ' Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.payment.report_payment',
          compact(['title', 'dateNow', 'payment', 'month', 'year', 'totalRevenue', 'pending', 'expired', 'failed', 'success'])
        );

      return $pdf->stream('laporan_pembayaran_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $payment = Payment::with(['order', 'offline_order'])
        ->whereYear('created_at', $request->year)
        ->orderBy('created_at', 'desc')
        ->get();

      $totalRevenue = Payment::whereHas('order')
        ->whereYear('created_at', $request->year)
        ->withSum('order', 'total')
        ->get()
        ->sum('order_sum_total')
        +
        Payment::whereHas('offline_order')
        ->whereYear('created_at', $request->year)
        ->withSum('offline_order', 'total')
        ->get()
        ->sum('offline_order_sum_total');

      $year = $request->year;

      $pending = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'pending')
        ->count();
      $expired = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'expired')
        ->count();
      $failed = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'failed')
        ->count();
      $success = Payment::whereYear('created_at', $request->year)
        ->where('payment_status', 'success')
        ->count();
      $title = 'Laporan Pembayaran Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.payment.report_payment',
          compact(['title', 'dateNow', 'payment', 'year', 'totalRevenue', 'pending', 'expired', 'failed', 'success'])
        );

      return $pdf->stream('laporan_pembayaran_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $payment = Payment::with(['order', 'offline_order'])
        ->orderBy('created_at', 'desc')
        ->get();

      $totalRevenue = Payment::whereHas('order')
        ->withSum('order', 'total')
        ->get()
        ->sum('order_sum_total')
        +
        Payment::whereHas('offline_order')
        ->withSum('offline_order', 'total')
        ->get()
        ->sum('offline_order_sum_total');

      $pending = Payment::where('payment_status', 'pending')->count();
      $expired = Payment::where('payment_status', 'expired')->count();
      $failed = Payment::where('payment_status', 'failed')->count();
      $success = Payment::where('payment_status', 'success')->count();
      $title = 'Laporan Pembayaran';

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.payment.report_payment',
          compact(['title', 'dateNow', 'payment', 'totalRevenue', 'pending', 'expired', 'failed', 'success'])
        );

      return $pdf->stream('laporan_pembayaran' . random_int(0000, 9999) . ".pdf");
    }
  }
}
