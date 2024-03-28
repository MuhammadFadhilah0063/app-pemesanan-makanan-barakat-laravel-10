<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = RawMaterial::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.button_actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.data_master.material.material', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name'   => 'required',
                'unit'   => 'required',
                'stock'   => 'required|numeric',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'unit.required' => 'Unit harus dipilih!',
                'stock.required' => 'Stok harus diisi!',
                'stock.numeric'  => 'Stok harus diisi angka!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                $material = RawMaterial::create([
                    'name' => $request->name,
                    'unit' => $request->unit,
                    'stock' => $request->stock,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil tambah bahan baku baru',
                'data' => $material
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = RawMaterial::where('id', $id)->firstOrFail();

        return response()->json([
            'message' => 'Data bahan baku',
            'data' => $material,
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
                'name'   => 'required',
                'unit'   => 'required',
                'stock'   => 'required|numeric',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'unit.required' => 'Unit harus dipilih!',
                'stock.required' => 'Stok harus diisi!',
                'stock.numeric'  => 'Stok harus diisi angka!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                $material = RawMaterial::findOrFail($id);

                // update material
                $material->update([
                    'name' => $request->name,
                    'stock' => $request->stock,
                    'unit' => $request->unit,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil ubah bahan baku',
                'data' => $material
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = RawMaterial::findOrFail($id);

        $material->delete();

        return response()->json([
            'message' => 'Berhasil dihapus',
            'data' => $material,
        ], 200);
    }
}
