<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\OfflineOrder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class OfflineOrderReportController extends Controller
{
    /**
     * menampilkan halaman offline order report
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if ($request->year != '' && $request->month != '') {
                $query = OfflineOrder::whereYear('updated_at', $request->year)
                    ->whereMonth('updated_at', $request->month)
                    ->latest();
            } else if ($request->year != '') {
                $query = OfflineOrder::whereYear('updated_at', $request->year)
                    ->latest();
            } else {
                $query = OfflineOrder::latest();
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('order_status', 'components.data-tables.order_status')
                ->rawColumns(['order_status'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.report.offline-order.offline_order_report', compact('transaction'));
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
            $order = OfflineOrder::whereYear('updated_at', $request->year)
                ->whereMonth('updated_at', $request->month)
                ->latest()
                ->get();
            $totalRevenue = OfflineOrder::whereYear('updated_at', $request->year)
                ->whereMonth('updated_at', $request->month)
                ->sum('total');

            $month = indonesianMonth($request->month);
            $year = $request->year;

            $process = OfflineOrder::whereYear('updated_at', $request->year)
                ->whereMonth('updated_at', $request->month)
                ->where('status', 'process')
                ->count();
            $success = OfflineOrder::whereYear('updated_at', $request->year)
                ->whereMonth('updated_at', $request->month)
                ->where('status', 'success')
                ->count();
            $failed = OfflineOrder::whereYear('updated_at', $request->year)
                ->whereMonth('updated_at', $request->month)
                ->where('status', 'failed')
                ->count();
            $title = 'Laporan Pesanan Offline Bulan ' . $month . ' Tahun ' . $year;

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.offline-order.report_offline_order',
                    compact(['title', 'dateNow', 'order', 'month', 'year', 'totalRevenue', 'process', 'success', 'failed'])
                );

            return $pdf->stream('laporan_pesanan_offline_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
        } else if ($request->year != '') {

            // Cetak berdasarkan tahun
            $order = OfflineOrder::whereYear('updated_at', $request->year)
                ->latest()
                ->get();
            $totalRevenue = OfflineOrder::whereYear('updated_at', $request->year)->sum('total');

            $year = $request->year;

            $process = OfflineOrder::whereYear('updated_at', $request->year)
                ->where('status', 'process')
                ->count();
            $success = OfflineOrder::whereYear('updated_at', $request->year)
                ->where('status', 'success')
                ->count();
            $failed = OfflineOrder::whereYear('updated_at', $request->year)
                ->where('status', 'failed')
                ->count();
            $title = 'Laporan Pesanan Offline Tahun ' . $year;

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.offline-order.report_offline_order',
                    compact(['title', 'dateNow', 'order', 'year', 'totalRevenue', 'process', 'success', 'failed'])
                );

            return $pdf->stream('laporan_pesanan_offline_' . $year . '_' . random_int(0000, 9999) . ".pdf");
        } else {

            // Cetak semua
            $order = OfflineOrder::latest()
                ->get();
            $totalRevenue = OfflineOrder::sum('total');
            $process = OfflineOrder::where('status', 'process')->count();
            $success = OfflineOrder::where('status', 'success')->count();
            $failed = OfflineOrder::where('status', 'failed')->count();
            $title = 'Laporan Pesanan Offline';

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.offline-order.report_offline_order',
                    compact(['title', 'dateNow', 'order', 'totalRevenue', 'process', 'success', 'failed'])
                );

            return $pdf->stream('laporan_pesanan_offline' . random_int(0000, 9999) . ".pdf");
        }
    }
}
