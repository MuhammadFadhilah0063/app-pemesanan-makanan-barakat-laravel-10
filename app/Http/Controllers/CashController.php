<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CashController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = Cash::query();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.data_master.cash.cash', compact('transaction'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validation = Validator::make(
      $request->all(),
      [
        'cash'   => 'required|unique:cash',
        'total'   => 'required',
      ],
      [
        'cash.required' => 'Nama harus diisi!',
        'cash.unique' => 'Kas sudah ada!',
        'total.required' => 'Total harus diisi!',
      ]
    );

    if ($validation->fails()) {
      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        $cash = Cash::create([
          'cash' => $request->cash,
          'total' => $request->total,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil tambah kas baru',
        'data' => $cash
      ], 200);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $cash = Cash::where('id', $id)->firstOrFail();

    return response()->json([
      'message' => 'Data kas',
      'data' => $cash,
    ], 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validation = Validator::make(
      $request->all(),
      [
        'cash'   => ['required', Rule::unique('cash')->ignore($id)],
        'total'   => 'required',
      ],
      [
        'cash.required' => 'Nama harus diisi!',
        'cash.unique' => 'Kas sudah ada!',
        'total.required' => 'Total harus diisi!',
      ]
    );

    if ($validation->fails()) {
      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        $cash = Cash::findOrFail($id);

        // update material
        $cash->update([
          'cash' => $request->cash,
          'total' => $request->total,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil ubah kas',
        'data' => $cash
      ], 200);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $cash = Cash::findOrFail($id);

    if ($id != 1) {
      $cash->delete();
    } else {
      return response()->json([
        'message' => 'Data ini tidak boleh dihapus',
        'data' => $cash,
      ], 400);
    }

    return response()->json([
      'message' => 'Berhasil dihapus',
      'data' => $cash,
    ], 200);
  }
}
