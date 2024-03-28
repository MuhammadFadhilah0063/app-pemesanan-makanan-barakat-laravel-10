<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (request()->ajax()) {
      $query =  Payment::with(['order', 'offline_order'])->latest();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('total', 'components.data-tables.transaction-payment.payment_total')
        ->addColumn('order', 'components.data-tables.transaction-payment.order_id')
        ->addColumn('order_status', 'components.data-tables.transaction-payment.order_status')
        ->addColumn('payment_status', 'components.data-tables.transaction-payment.payment_status')
        ->addColumn('action', 'components.data-tables.transaction-payment.button_action')
        ->rawColumns(['total', 'order', 'order_status', 'payment_status', 'action'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.payment.payment', compact('transaction'));
  }

  /**
   * Display the specified resource.
   */
  public function detail($id)
  {
    $payment = Payment::with(['order', 'offline_order'])->where('payment_id', $id)->first();

    return response()->json([
      'message' => 'Data pembayaran',
      'data' => $payment
    ]);
  }
}
