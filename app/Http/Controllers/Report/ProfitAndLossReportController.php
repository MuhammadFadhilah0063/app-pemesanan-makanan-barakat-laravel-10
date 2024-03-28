<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\OfflineOrder;
use App\Models\OnlineOrder;
use App\Models\PurchaseOfRawMaterial;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class ProfitAndLossReportController extends Controller
{
    /**
     * menampilkan halaman cash flow report
     */
    public function index(Request $request)
    {
        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.report.profit-and-loss.profit_and_loss_report', compact('transaction'));
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
            $month = indonesianMonth($request->month);
            $year = $request->year;

            $onlineOrder = OnlineOrder::where('status', 'success')
                ->whereYear('pick_up_date', $request->year)
                ->whereMonth('pick_up_date', $request->month)
                ->sum('total');
            $offlineOrder = OfflineOrder::where('status', 'success')
                ->whereYear('created_at', $request->year)
                ->whereMonth('created_at', $request->month)
                ->sum('total');
            $sale = Sale::whereYear('sale_date', $request->year)
                ->whereMonth('sale_date', $request->month)
                ->sum('total');

            $purchase = PurchaseOfRawMaterial::whereYear('purchase_date', $request->year)
                ->whereMonth('purchase_date', $request->month)
                ->sum('total');
            $expense = Expense::select('description', 'total', 'expense_date')
                ->whereYear('expense_date', $request->year)
                ->whereMonth('expense_date', $request->month)
                ->orderBy('expense_date', 'ASC')
                ->get();
            $totalExpense = Expense::whereYear('expense_date', $request->year)
                ->whereMonth('expense_date', $request->month)
                ->sum('total');

            $totalDebit = $onlineOrder + $offlineOrder + $sale;
            $totalKredit = $purchase + $totalExpense;
            $totalProfitOrLoss = $totalDebit - $totalKredit;

            $title = 'Laporan Laba dan Rugi Bulan ' . $month . ' Tahun ' . $year;

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.profit-and-loss.report_profit_and_loss',
                    compact(
                        ['title', 'dateNow', 'onlineOrder', 'offlineOrder', 'sale', 'purchase', 'expense', 'totalDebit', 'totalKredit', 'totalProfitOrLoss', 'year', 'month']
                    )
                );

            return $pdf->stream('laporan_laba_dan_rugi_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
        } else if ($request->year != '') {

            // Cetak berdasarkan tahun
            $year = $request->year;

            $onlineOrder = OnlineOrder::where('status', 'success')
                ->whereYear('pick_up_date', $request->year)
                ->sum('total');
            $offlineOrder = OfflineOrder::where('status', 'success')
                ->whereYear('created_at', $request->year)
                ->sum('total');
            $sale = Sale::whereYear('sale_date', $request->year)
                ->sum('total');

            $purchase = PurchaseOfRawMaterial::whereYear('purchase_date', $request->year)
                ->sum('total');
            $expense = Expense::select('description', 'total', 'expense_date')
                ->whereYear('expense_date', $request->year)
                ->orderBy('expense_date', 'ASC')
                ->get();
            $totalExpense = Expense::whereYear('expense_date', $request->year)
                ->sum('total');

            $totalDebit = $onlineOrder + $offlineOrder + $sale;
            $totalKredit = $purchase + $totalExpense;
            $totalProfitOrLoss = $totalDebit - $totalKredit;

            $title = 'Laporan Laba dan Rugi ' . $year;

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.profit-and-loss.report_profit_and_loss',
                    compact(
                        ['title', 'dateNow', 'onlineOrder', 'offlineOrder', 'sale', 'purchase', 'expense', 'totalDebit', 'totalKredit', 'totalProfitOrLoss', 'year']
                    )
                );

            return $pdf->stream('laporan_laba_dan_rugi_' . $year . '_' . random_int(0000, 9999) . ".pdf");
        } else {
            // Cetak semua
            $onlineOrder = OnlineOrder::where('status', 'success')->sum('total');
            $offlineOrder = OfflineOrder::where('status', 'success')->sum('total');
            $sale = Sale::sum('total');

            $purchase = PurchaseOfRawMaterial::sum('total');
            $expense = Expense::select('description', 'total', 'expense_date')
                ->orderBy('expense_date', 'ASC')
                ->get();
            $totalExpense = Expense::sum('total');

            $totalDebit = $onlineOrder + $offlineOrder + $sale;
            $totalKredit = $purchase + $totalExpense;
            $totalProfitOrLoss = $totalDebit - $totalKredit;

            $title = 'Laporan Laba dan Rugi';

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
                ->loadview(
                    'dashboard.report.profit-and-loss.report_profit_and_loss',
                    compact(
                        ['title', 'dateNow', 'onlineOrder', 'offlineOrder', 'sale', 'purchase', 'expense', 'totalDebit', 'totalKredit', 'totalProfitOrLoss']
                    )
                );

            return $pdf->stream('laporan_laba_dan_rugi' . random_int(0000, 9999) . ".pdf");
        }
    }
}
