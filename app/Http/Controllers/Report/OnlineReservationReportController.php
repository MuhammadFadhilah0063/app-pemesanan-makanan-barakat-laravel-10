<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class OnlineReservationReportController extends Controller
{
  /**
   * menampilkan halaman online reservation report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = Reservation::with(['online_order'])
          ->where('reservation_id', 'LIKE', 'RSV%')
          ->whereYear('reservation_date', $request->year)
          ->whereMonth('reservation_date', $request->month)
          ->orderBy('reservation_date', 'desc')
          ->orderBy('reservation_time', 'desc');
      } else if ($request->year != '') {
        $query = Reservation::with(['online_order'])
          ->where('reservation_id', 'LIKE', 'RSV%')
          ->whereYear('reservation_date', $request->year)
          ->orderBy('reservation_date', 'desc')
          ->orderBy('reservation_time', 'desc');
      } else {
        $query = Reservation::with(['online_order'])
          ->where('reservation_id', 'LIKE', 'RSV%')
          ->orderBy('reservation_date', 'desc')
          ->orderBy('reservation_time', 'desc');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('reservation_status', 'components.data-tables.reservation_status')
        ->rawColumns(['reservation_status'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.online-reservation.online_reservation_report', compact('transaction'));
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
      $reservation = Reservation::with(['online_order'])
        ->where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->whereMonth('reservation_date', $request->month)
        ->orderBy('reservation_date', 'desc')
        ->orderBy('reservation_time', 'desc')
        ->get();

      $month = indonesianMonth($request->month);
      $year = $request->year;

      $pending = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->whereMonth('reservation_date', $request->month)
        ->where('reservation_status', 'pending')
        ->count();
      $process = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->whereMonth('reservation_date', $request->month)
        ->where('reservation_status', 'process')
        ->count();
      $success = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->whereMonth('reservation_date', $request->month)
        ->where('reservation_status', 'success')
        ->count();
      $failed = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->whereMonth('reservation_date', $request->month)
        ->where('reservation_status', 'failed')
        ->count();
      $title = 'Laporan Reservasi Online Bulan ' . $month . ' Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-reservation.report_online_reservation',
          compact(['pending', 'process', 'success', 'failed', 'title', 'dateNow', 'reservation', 'month', 'year'])
        );

      return $pdf->stream('laporan_reservasi_online_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $reservation = Reservation::with(['online_order'])
        ->where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->orderBy('reservation_date', 'desc')
        ->orderBy('reservation_time', 'desc')
        ->get();

      $year = $request->year;

      $pending = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->where('reservation_status', 'pending')
        ->count();
      $process = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->where('reservation_status', 'process')
        ->count();
      $success = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->where('reservation_status', 'success')
        ->count();
      $failed = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->whereYear('reservation_date', $request->year)
        ->where('reservation_status', 'failed')
        ->count();
      $title = 'Laporan Reservasi Online Tahun ' . $year;

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-reservation.report_online_reservation',
          compact(['pending', 'process', 'success', 'failed', 'title', 'dateNow', 'reservation', 'year'])
        );

      return $pdf->stream('laporan_reservasi_online_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $reservation = Reservation::with(['online_order'])
        ->where('reservation_id', 'LIKE', 'RSV%')
        ->orderBy('reservation_date', 'desc')
        ->orderBy('reservation_time', 'desc')
        ->get();

      $pending = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->where('reservation_status', 'pending')
        ->count();
      $process = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->where('reservation_status', 'process')
        ->count();
      $success = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->where('reservation_status', 'success')
        ->count();
      $failed = Reservation::where('reservation_id', 'LIKE', 'RSV%')
        ->where('reservation_status', 'failed')
        ->count();
      $title = 'Laporan Reservasi Online';

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview(
          'dashboard.report.online-reservation.report_online_reservation',
          compact(['pending', 'process', 'success', 'failed', 'title', 'dateNow', 'reservation'])
        );

      return $pdf->stream('laporan_reservasi_online' . random_int(0000, 9999) . ".pdf");
    }
  }
}
