<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Supplier::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.button_actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.data_master.supplier.supplier', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name'   => 'required|unique:suppliers',
                'phone'   => 'required',
                'address'   => 'required',
                'description'   => 'required',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'name.unique' => 'Pemasok sudah ada!',
                'phone.required' => 'Nomor harus diisi!',
                'address.required' => 'Alamat harus diisi!',
                'description.required' => 'Deskripsi harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                $supplier = Supplier::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'description' => $request->description,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil tambah pemasok baru',
                'data' => $supplier
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::where('id', $id)->firstOrFail();

        return response()->json([
            'message' => 'Data pemasok',
            'data' => $supplier,
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
                'name'   => ['required', Rule::unique('suppliers')->ignore($id)],
                'phone'   => 'required',
                'address'   => 'required',
                'description'   => 'required',
            ],
            [
                'name.required' => 'Nama harus diisi!',
                'name.unique' => 'Pemasok sudah ada!',
                'phone.required' => 'Nomor harus diisi!',
                'address.required' => 'Alamat harus diisi!',
                'description.required' => 'Deskripsi harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                $supplier = Supplier::findOrFail($id);

                // update material
                $supplier->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'description' => $request->description,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil ubah pemasok',
                'data' => $supplier
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return response()->json([
            'message' => 'Berhasil dihapus',
            'data' => $supplier,
        ], 200);
    }
}
