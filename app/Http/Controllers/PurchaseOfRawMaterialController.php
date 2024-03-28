<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\PurchaseOfRawMaterial;
use App\Models\RawMaterial;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PurchaseOfRawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query =  PurchaseOfRawMaterial::with(['raw_material', 'supplier'])->orderBy('purchase_date', 'desc')->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.transaction-purchase.button_actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.transaction.purchase.purchase', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = RawMaterial::get();
        $supplier = Supplier::get();
        $html = view('components.dashboard.modal.body.body_purchase_add', compact(['material', 'supplier']))->render();

        return response()->json(['message' => 'modal purchase add', 'html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $purchaseId = makeId('PCH');

        try {
            $purchase = PurchaseOfRawMaterial::create([
                'purchase_id' => $purchaseId,
                'purchase_date' => $request->purchase_date,
                'total' => $request->total,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'raw_material_id' => $request->raw_material_id,
            ]);

            if ($request->supplier_id) {
                $purchase->update(['supplier_id' => $request->supplier_id]);
            }

            $material = RawMaterial::where('id', $request->raw_material_id)->first();
            $material->addStock($request->quantity);

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
        $purchase = PurchaseOfRawMaterial::where('purchase_id', $id)->with(['raw_material', 'supplier'])->first();

        return response()->json([
            'message' => 'Data pembelian bahan',
            'data' => $purchase
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = PurchaseOfRawMaterial::where('purchase_id', $id)->with(['raw_material', 'supplier'])->first();
        $material = RawMaterial::get();
        $supplier = Supplier::get();
        $html = view('components.dashboard.modal.body.body_purchase_edit', compact(['purchase', 'material', 'supplier']))->render();

        return response()->json(['message' => 'modal purchase edit', 'html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $purchase = PurchaseOfRawMaterial::where('purchase_id', $id)->first();
            $old_quantity = $purchase->quantity;
            $new_quantity = $request->quantity;
            $old_total = $purchase->total;
            $new_total = $request->total;

            $purchase->update([
                'purchase_date' => $request->purchase_date,
                'total' => $new_total,
                'quantity' => $request->quantity,
                'quantity' => $new_quantity,
                'unit_price' => $request->unit_price,
                'unit_price' => $request->unit_price,
                'raw_material_id' => $request->raw_material_id,
            ]);

            if ($request->supplier_id) {
                $purchase->update(['supplier_id' => $request->supplier_id]);
            }

            $material = RawMaterial::where('id', $request->raw_material_id)->first();
            $material->addStock($new_quantity - $old_quantity);

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
            $purchase = PurchaseOfRawMaterial::where('purchase_id', $id)->first();

            $purchase->delete();

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
