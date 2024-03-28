<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Expense;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query =  Expense::latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.transaction-expense.button_actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.transaction.expense.expense', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $html = view('components.dashboard.modal.body.body_expense_add')->render();

        return response()->json(['message' => 'modal expense add', 'html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $expenseId = makeId('EXP');

        try {
            Expense::create([
                'expense_id' => $expenseId,
                'expense_date' => $request->expense_date,
                'total' => $request->total,
                'description' => $request->description,
            ]);

            $cash = Cash::where('id', 1)->first();
            $status = $cash->reduceCash(intval($request->total));

            if ($status == false) {
                DB::rollBack();

                return response()->json([
                    'message' => 'Saldo kas tidak cukup',
                ], 400);
            }

            DB::commit();

            return response()->json([
                'message' => 'Berhasil',
            ], 200);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Gagal',
                'err' => $err,
            ], 400);

            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::where('expense_id', $id)->first();

        return response()->json([
            'message' => 'Data pengeluaran',
            'data' => $expense
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::where('expense_id', $id)->first();
        $html = view('components.dashboard.modal.body.body_expense_edit', compact(['expense']))->render();

        return response()->json(['message' => 'modal expense edit', 'html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $expense = Expense::where('expense_id', $id)->first();
            $old_total = $expense->total;
            $new_total = $request->total;

            $expense->update([
                'expense_date' => $request->expense_date,
                'total' => $new_total,
                'description' => $request->description,
            ]);

            $cash = Cash::where('id', 1)->first();
            $cash->reduceCash(intval($new_total - $old_total));

            DB::commit();

            return response()->json([
                'message' => 'Berhasil',
            ], 200);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Gagal',
                'err' => $err,
            ], 400);

            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $expense = Expense::where('expense_id', $id)->first();

            $expense->delete();

            DB::commit();

            return response()->json([
                'message' => 'Berhasil hapus',
            ], 200);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Gagal hapus',
                'err' => $err,
            ], 400);

            DB::rollBack();
        }
    }
}
