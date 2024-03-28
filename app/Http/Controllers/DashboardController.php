<?php

namespace App\Http\Controllers;

use App\Models\OfflineOrder;
use App\Models\OnlineOrder;
use App\Models\Reservation;
use App\Models\Sale;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
  /**
   * menampilkan halaman dashboard
   */
  public function index()
  {
    if (request()->ajax()) {
      // Ambil reservation hari ini dan urutkan waktu reservasi terdahulu
      $query =  Reservation::where('reservation_id', 'LIKE', 'ROF%')
        ->where('reservation_date', Carbon::today())
        ->where('waiting', 1)
        ->orderBy('reservation_time');

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_home_waiting')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // count online order
    $onlineOrder = [
      'pending' => OnlineOrder::where('status', 'pending')->count(),
      'success' => OnlineOrder::where('status', 'success')->count(),
      'process' => OnlineOrder::where('status', 'process')->count(),
      'failed' => OnlineOrder::where('status', 'failed')->count(),
    ];

    // count offline order
    $offlineOrder = [
      'pending' => OfflineOrder::where('status', 'pending')->count(),
      'success' => OfflineOrder::where('status', 'success')->count(),
      'process' => OfflineOrder::where('status', 'process')->count(),
      'failed' => OfflineOrder::where('status', 'failed')->count(),
    ];

    // count offline reservation
    $offlineReservation = [
      'pending' => Reservation::where('reservation_id', 'LIKE', 'ROF%')->where('reservation_status', 'pending')->count(),
      'success' => Reservation::where('reservation_id', 'LIKE', 'ROF%')->where('reservation_status', 'success')->count(),
      'process' => Reservation::where('reservation_id', 'LIKE', 'ROF%')->where('reservation_status', 'process')->count(),
      'failed' => Reservation::where('reservation_id', 'LIKE', 'ROF%')->where('reservation_status', 'failed')->count(),
    ];

    // count online reservation
    $onlineReservation = [
      'pending' => Reservation::where('reservation_id', 'LIKE', 'RSV%')->where('reservation_status', 'pending')->count(),
      'success' => Reservation::where('reservation_id', 'LIKE', 'RSV%')->where('reservation_status', 'success')->count(),
      'process' => Reservation::where('reservation_id', 'LIKE', 'RSV%')->where('reservation_status', 'process')->count(),
      'failed' => Reservation::where('reservation_id', 'LIKE', 'RSV%')->where('reservation_status', 'failed')->count(),
    ];

    // year and month
    $year   = date('Y');
    $month  = date('m');

    // statistic revenue online and offline order
    $revenue = [
      'revenueMonth' => OnlineOrder::where('status', 'success')
        ->whereMonth('pick_up_date', '=', $month)
        ->whereYear('pick_up_date', $year)
        ->sum('total')
        + OfflineOrder::where('status', 'success')
        ->whereMonth('created_at', '=', $month)
        ->whereYear('created_at', $year)
        ->sum('total')
        + Sale::whereMonth('sale_date', '=', $month)
        ->whereYear('sale_date', $year)
        ->sum('total'),

      'revenueYear'  => OnlineOrder::where('status', 'success')
        ->whereYear('pick_up_date', $year)
        ->sum('total')
        + OfflineOrder::where('status', 'success')
        ->whereYear('created_at', $year)
        ->sum('total')
        + Sale::whereYear('created_at', $year)
        ->sum('total'),

      'revenueAll'   => OnlineOrder::where('status', 'success')
        ->sum('total')
        + OfflineOrder::where('status', 'success')
        ->sum('total')
        + Sale::sum('total'),
    ];

    // data untuk grafik
    $dataPesanan = OnlineOrder::selectRaw("MONTH(pick_up_date) as bulan, COUNT(*) as jumlah_transaksi")
      ->whereYear('pick_up_date', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $dataPesanan2 = OfflineOrder::selectRaw("MONTH(created_at) as bulan, COUNT(*) as jumlah_transaksi")
      ->whereYear('created_at', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $dataReservasi = Reservation::selectRaw("MONTH(reservation_date) as bulan, COUNT(*) as jumlah_transaksi")
      ->where('reservation_id', 'LIKE', 'RSV%')
      ->whereYear('reservation_date', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    $dataReservasi2 = Reservation::selectRaw("MONTH(reservation_date) as bulan, COUNT(*) as jumlah_transaksi")
      ->where('reservation_id', 'LIKE', 'ROF%')
      ->whereYear('reservation_date', now()->year)
      ->groupBy('bulan')
      ->orderBy('bulan')
      ->get();

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view(
      'dashboard.home',
      compact('onlineOrder', 'offlineOrder', 'offlineReservation', 'onlineReservation', 'revenue', 'transaction', 'dataPesanan', 'dataPesanan2', 'dataReservasi', 'dataReservasi2')
    );
  }
}
