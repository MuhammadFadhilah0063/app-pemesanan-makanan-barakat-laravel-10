<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Selling;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SellingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (request()->ajax()) {
      $query = Selling::query();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_selling')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.data_master.selling.selling', compact('transaction'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validation = Validator::make(
      $request->all(),
      [
        'name'   => 'required|unique:selling',
        'unit'   => 'required',
        'stok'   => 'required|numeric',
        'price'   => 'required|numeric',
      ],
      [
        'name.required' => 'Nama harus diisi!',
        'name.unique' => 'Jualan sudah ada!',
        'unit.required' => 'Unit harus dipilih!',
        'stok.required' => 'Stok harus diisi!',
        'stok.numeric'  => 'Stok harus diisi angka!',
        'price.required' => 'Harga harus diisi!',
        'price.numeric'  => 'Harga harus diisi angka!',
      ]
    );

    if ($validation->fails()) {
      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        $selling = Selling::create([
          'name' => $request->name,
          'unit' => $request->unit,
          'stock' => $request->stok,
          'price' => $request->price,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil tambah jualan baru',
        'data' => $selling
      ], 200);
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $selling = Selling::where('selling_id', $id)->firstOrFail();

    return response()->json([
      'message' => 'Data jualan',
      'data' => $selling,
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
        'name'   => [
          'required',
          Rule::unique('selling')->ignore($id, 'selling_id')
        ],
        'unit'   => 'required',
        'stok'   => 'required|numeric',
        'price'   => 'required|numeric',
      ],
      [
        'name.required' => 'Nama harus diisi!',
        'name.unique' => 'Jualan sudah ada!',
        'unit.required' => 'Unit harus dipilih!',
        'stok.required' => 'Stok harus diisi!',
        'stok.numeric'  => 'Stok harus diisi angka!',
        'price.required' => 'Harga harus diisi!',
        'price.numeric'  => 'Harga harus diisi angka!',
      ]
    );

    if ($validation->fails()) {
      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        $selling = Selling::findOrFail($id);

        // update selling
        $selling->update([
          'name' => $request->name,
          'stock' => $request->stok,
          'unit' => $request->unit,
          'price' => $request->price,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil ubah jualan',
        'data' => $selling
      ], 200);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $selling = Selling::findOrFail($id);

    $selling->delete();

    return response()->json([
      'message' => 'Berhasil dihapus',
      'data' => $selling,
    ], 200);
  }
}
