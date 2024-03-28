<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class ExpenseReportController extends Controller
{
  /**
   * menampilkan halaman expense report
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if ($request->year != '' && $request->month != '') {
        $query = Expense::whereYear('expense_date', $request->year)
          ->whereMonth('expense_date', $request->month)
          ->orderBy('expense_date', 'desc');
      } else if ($request->year != '') {
        $query = Expense::whereYear('expense_date', $request->year)
          ->orderBy('expense_date', 'desc');
      } else {
        $query = Expense::orderBy('expense_date', 'desc');
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.report.expense.expense_report', compact('transaction'));
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
      $expense = Expense::whereYear('expense_date', $request->year)
        ->whereMonth('expense_date', $request->month)
        ->orderBy('expense_date', 'desc')
        ->get();

      $month = indonesianMonth($request->month);
      $year = $request->year;
      $title = 'Laporan Pengeluaran Bulan ' . $month . ' Tahun ' . $year;
      $total = Expense::whereYear('expense_date', $request->year)
        ->whereMonth('expense_date', $request->month)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.expense.report_expense', compact(['title', 'dateNow', 'total', 'expense', 'month', 'year']));

      return $pdf->stream('laporan_pengeluaran_bulan_' . $month . '_tahun_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else if ($request->year != '') {

      // Cetak berdasarkan tahun
      $expense = Expense::whereYear('expense_date', $request->year)
        ->orderBy('expense_date', 'desc')
        ->get();

      $year = $request->year;
      $title = 'Laporan Pengeluaran Tahun ' . $year;
      $total = Expense::whereYear('expense_date', $request->year)
        ->sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.expense.report_expense', compact(['title', 'dateNow', 'total', 'expense', 'year']));

      return $pdf->stream('laporan_pengeluaran_' . $year . '_' . random_int(0000, 9999) . ".pdf");
    } else {

      // Cetak semua
      $expense = Expense::orderBy('expense_date', 'desc')->get();
      $title = 'Laporan Pengeluaran';
      $total = Expense::sum('total');

      $pdf = PDF::setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
      ])
        ->setPaper(array(0, 0, 609.449, 935.433), 'landscape')
        ->loadview('dashboard.report.expense.report_expense', compact(['title', 'dateNow', 'total', 'expense']));

      return $pdf->stream('laporan_pengeluaran' . random_int(0000, 9999) . ".pdf");
    }
  }
}
