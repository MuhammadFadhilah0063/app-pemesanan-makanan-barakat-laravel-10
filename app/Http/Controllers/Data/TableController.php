<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $query = Table::query();

            // Select
            if ($request->ready != 'select') {
                $query = Table::query()->where('ready', $request->ready);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.button_actions')
                ->addColumn('image', 'components.data-tables.image')
                ->addColumn('ready_btn', 'components.data-tables.button_status_table')
                ->rawColumns(['actions', 'image', 'ready_btn'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.data_master.table.table', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'image'         => 'sometimes|image|mimes:jpeg,jpg,png|max:2000',
            ],
            [
                'image.image'    => 'File harus berupa gambar!',
                'image.mimes'    => 'Format gambar yang diperbolehkan adalah JPEG, JPG, dan PNG!',
                'image.max'      => 'Ukuran gambar maksimal adalah 2MB!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                // Ambil image
                if ($request->file('image')) {
                    // Ambil data image
                    $imageName = $request->file('image')->hashName();
                    $image = $request->file('image');

                    // Simpan image
                    $image->storeAs('public/image/table', $imageName);
                } else {
                    $imageName = 'img.png';
                }

                $table = Table::create([
                    'image' => $imageName,
                    'description' => $request->description,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil tambah meja baru',
                'data' => $table
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $table = Table::where('id', $id)->firstOrFail();

        return response()->json([
            'message' => 'Data meja',
            'data' => $table,
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
                'image'         => 'sometimes|image|mimes:jpeg,jpg,png|max:2000',
            ],
            [
                'image.image'    => 'File harus berupa gambar!',
                'image.mimes'    => 'Format gambar yang diperbolehkan adalah JPEG, JPG, dan PNG!',
                'image.max'      => 'Ukuran gambar maksimal adalah 2MB!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {

            try {
                $table = Table::findOrFail($id);

                // Ambil image
                if ($request->file('image')) {
                    // Ambil data image
                    $imageName = $request->file('image')->hashName();
                    $image = $request->file('image');

                    // Hapus image lama - kecuali image default
                    if ($table->image != asset('storage/image/table/img.png')) {
                        Storage::disk('local')->delete('public/image/table/' . basename($table->image));
                    }

                    // Simpan image
                    $image->storeAs('public/image/table', $imageName);

                    // Ada image baru - update image
                    $table->update([
                        'image' => $imageName,
                    ]);
                }

                // Update table
                $table->update([
                    'description' => $request->description,
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'error' => $e
                ], 400);
            }

            return response()->json([
                'message' => 'Berhasil ubah meja',
                'data' => $table
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);

        // Hapus image lama - kecuali image default
        if ($table->image != asset('storage/image/table/img.png')) {
            Storage::disk('local')->delete('public/image/table/' . basename($table->image));
        }

        $table->delete();

        return response()->json([
            'message' => 'Berhasil dihapus',
            'data' => $table,
        ], 200);
    }

    /**
     * Update status ready menu
     */
    public function updateReady(Request $request, Table $table)
    {
        try {
            $table->update(['ready' => ($request->ready === '1') ? 0 : 1]);

            $pesanStatus = ($request->ready === '1') ? 'tidak tersedia' : 'tersedia';

            return response()->json([
                'message' => "Berhasil ubah status meja menjadi $pesanStatus",
                'data' => $table,
            ], 200);
        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Gagal merubah status',
                'error' => $err
            ], 400);
        }
    }
}
