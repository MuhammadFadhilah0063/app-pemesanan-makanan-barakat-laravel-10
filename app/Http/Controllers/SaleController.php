<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Selling;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (request()->ajax()) {
      $query =  Sale::orderBy('sale_date', 'desc')->latest();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.transaction-sale.button_actions')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.sale.sale', compact('transaction'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function create()
  {
    $selling = Selling::get();
    $html = view('components.dashboard.modal.body.body_sale_add', compact(['selling']))->render();

    return response()->json(['message' => 'modal sale add', 'html' => $html]);
  }

  public function addItem(Request $request)
  {
    $selling = Selling::where('selling_id', $request->selling_id)->first();
    $html = view('components.dashboard.modal.body.item_add', compact(['selling']))->render();

    return response()->json([
      "html" => $html,
      "selling_name" => $selling->name
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    DB::beginTransaction();

    $saleId = makeId('SAL');

    try {
      Sale::create([
        'sale_id' => $saleId,
        'sale_date' => $request->sale_date,
        'total' => $request->total,
      ]);

      for ($i = 0; $i < count($request->sale_items); $i++) {
        SaleItem::create([
          'sale_id' => $saleId,
          'selling_id' => $request->sale_items[$i]['selling_id'],
          'quantity' => $request->sale_items[$i]['quantity'],
          'price' => $request->sale_items[$i]['price'],
        ]);

        // Mengurangi stok
        $selling = Selling::where('selling_id', $request->sale_items[$i]['selling_id'])->first();
        $selling->reduceStock($request->sale_items[$i]['quantity']);
      }

      // Tambahkan cash / pendapatan
      $cash = Cash::where('id', 1)->first();
      $cash->addCash(intval($request->total));

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
  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $sale = Sale::with(['sale_items', 'sale_items.selling'])->where('sale_id', $id)->first();

    return response()->json([
      'message' => 'Data penjualan',
      'data' => $sale
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $sale = Sale::with(['sale_items', 'sale_items.selling'])->where('sale_id', $id)->first();
    $selling = Selling::get();
    $html = view('components.dashboard.modal.body.body_sale_edit', compact(['selling', 'sale']))->render();

    return response()->json(['message' => 'modal sale edit', 'html' => $html]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    DB::beginTransaction();

    try {
      $sale = Sale::where('sale_id', $id)->first();
      $old_total = $sale->total;
      $new_total = $request->total;

      $sale->update([
        'sale_date' => $request->sale_date,
        'total' => $request->total,
      ]);

      $oldSaleItems = SaleItem::where('sale_id', $id)->get();

      // hapus item dan kembalikan stok
      for ($i = 0; $i < count($oldSaleItems); $i++) {
        $quantity = $oldSaleItems[$i]->quantity;
        $sellingId = $oldSaleItems[$i]->selling_id;

        // Kembalikan stok
        $selling = Selling::where('selling_id', $sellingId)->first();
        $selling->addStock($quantity);

        // hapus item
        SaleItem::where('id', $oldSaleItems[$i]->id)->delete();
      }

      for ($i = 0; $i < count($request->sale_items); $i++) {
        SaleItem::create([
          'sale_id' => $id,
          'selling_id' => $request->sale_items[$i]['selling_id'],
          'quantity' => $request->sale_items[$i]['quantity'],
          'price' => $request->sale_items[$i]['price'],
        ]);

        // Mengurangi stok
        $selling = Selling::where('selling_id', $request->sale_items[$i]['selling_id'])->first();
        $selling->reduceStock($request->sale_items[$i]['quantity']);
      }

      $cash = Cash::where('id', 1)->first();
      $cash->addCash(intval($new_total - $old_total));

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
      $sale = Sale::where('sale_id', $id)->first();

      $sale->delete();

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
