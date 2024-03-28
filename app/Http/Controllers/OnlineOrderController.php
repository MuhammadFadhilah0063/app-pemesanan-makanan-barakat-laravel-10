<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\OnlineOrder;
use App\Models\OnlineOrderItem;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Date;

class OnlineOrderController extends Controller
{
  /**
   * Menampilkan halaman order
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if (auth()->user()) {
        if ($request->status == 'all') {
          $orders = OnlineOrder::with(['order_items', 'payment', 'reservation', 'reservation.reservation_items', 'order_items.food'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('pick_up_date', 'DESC')
            ->orderBy('pick_up_time', 'DESC')
            ->get();
        } else {
          $orders = OnlineOrder::with(['order_items', 'payment', 'reservation', 'reservation.reservation_items', 'order_items.food'])
            ->where('user_id', auth()->user()->id)
            ->where('status', $request->status)
            ->orderBy('pick_up_date', 'DESC')
            ->orderBy('pick_up_time', 'DESC')
            ->get();
        }

        if (count($orders) == 0) {
          return view('components.home.orders.order-items-empty')->render();
        }

        return view('components.home.orders.order-items', compact(['orders']))->render();
      }
    }

    $orders = OnlineOrder::with(['order_items', 'payment', 'reservation', 'reservation.reservation_items', 'order_items.food'])
      ->where('user_id', auth()->user()->id)
      ->orderBy('pick_up_date', 'DESC')
      ->orderBy('pick_up_time', 'DESC')
      ->get();
    $carts = CartItem::with('food')->where('user_id', auth()->user()->id)
      ->where('status', 'pending')
      ->get();

    return view('home.orders', compact(['orders', 'carts']));
  }

  /**
   * proses order secara online
   */
  public function order(Request $request)
  {
    try {
      // Start transaction
      DB::beginTransaction();

      // Make id order
      $idOrder = makeId('OND');

      // Create order
      $order = OnlineOrder::create([
        'online_order_id' =>  $idOrder,
        'user_id' => auth()->user()->id,
        'name' => $request->order['name'],
        'phone' => $request->order['phone'],
        'address' => $request->order['address'],
        'pick_up_date' => $request->order['pick_up_date'],
        'pick_up_time' => $request->order['pick_up_time'],
        'estimation_time' => estimationTime($request->order['pick_up_time'], $request->order['estimation_time']),
        'total' => $request->order['total'],
        'message' => $request->order['message'],
        'payment_method' => $request->order['payment_method'],
      ]);

      // Create order items
      $orderItems = CartItem::whereIn('id', $request->order['order_items_id'])->get();

      for ($i = 0; $i < count($orderItems); $i++) {
        OnlineOrderItem::create([
          'online_order_id' =>  $idOrder,
          'food_id' => $orderItems[$i]->food_id,
          'quantity' => $orderItems[$i]->quantity,
          'price' => $orderItems[$i]->price,
        ]);
      }

      // Delete items from CartItems
      CartItem::whereIn('id', $request->order['order_items_id'])->delete();

      // Create payment
      Payment::create([
        'payment_id' => makeId('PYM'),
        'online_order_id' => $idOrder,
      ]);

      if ($request->order['payment_method'] == 'virtual') {

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
          'transaction_details' => [
            'order_id'      => $idOrder,
            'gross_amount'  => $request->order['total'],
          ],
          'customer_details' => [
            'first_name'       => $request->order['name'],
            'username'         => auth()->user()->username,
            'phone'            => $request->order['phone'],
          ]
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update([
          'snap_token' => $snapToken
        ]);
      }

      // Commit Transaction
      DB::commit();

      return response()->json([
        'message' => 'Berhasil',
        'data' => $order,
      ], 200);
    } catch (QueryException $err) {

      // Rollback Transaction
      DB::rollBack();

      return response()->json([
        'message' => 'Gagal',
        'error' => $err,
      ], 400);
    }
  }

  /**
   * proses batalkan orderan ketika status masih pending
   */
  public function cancelOrder($id)
  {
    $order = OnlineOrder::where('online_order_id', $id)->first();
    $payment = Payment::where('online_order_id', $id)->first();

    // ubah order
    $order->update(['status' => 'failed']);

    // ubah payment
    if ($payment->payment_status == 'pending') {
      $payment->update(['payment_status' => 'failed']);
    }

    // ubah reservation
    if ($order->reservation) {
      Reservation::where('reservation_id', $order->reservation->reservation_id)->first()->update(['reservation_status' => 'failed']);
    }

    return response()->json([
      'message' => 'Berhasil'
    ], 200);
  }

  /**
   * proses terima pesanan, jika status pesanan process
   */
  public function acceptOrder($id)
  {
    $order = OnlineOrder::where('online_order_id', $id)->first();

    // ubah order
    $order->update(['status' => 'success']);

    // ubah reservation
    if ($order->reservation) {
      Reservation::where('reservation_id', $order->reservation->reservation_id)->first()->update(['reservation_status' => 'success']);
    }
  }

  /**
   * proses render modal reservasi pada halaman orders
   * @return view modal-body-reservation-order
   */
  public function modalReservation(Request $request)
  {
    $order = OnlineOrder::where('online_order_id', $request->online_order_id)->first();
    $tables = Table::get();
    $html = view('components.home.modal.body.modal-body-reservation-in-order', compact(['tables', 'order']))->render();

    return response()->json([
      'message' => 'Modal body reservation order',
      'html' => $html,
    ], 200);
  }

  // Admin
  /**
   * menampilkan halaman online order pada dashboard admin
   */
  public function indexOnlineOrder()
  {
    if (request()->ajax()) {
      $query =  OnlineOrder::with(['reservation', 'payment'])
        ->orderBy('pick_up_date', 'desc')
        ->orderBy('pick_up_time', 'desc');

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_online_order')
        ->addColumn('order_status', 'components.data-tables.order_status')
        ->addColumn('payment_status', 'components.data-tables.payment_status')
        ->addColumn('reservation_status', 'components.data-tables.online_order_reservation_status',)
        ->addColumn('information', function ($data) {
          $estimatedTime = Carbon::parse($data->pick_up_date . $data->estimation_time);
          $currentDateTime = Carbon::now();

          $timeDifference = $estimatedTime->diff($currentDateTime);

          $estiationStatus = $estimatedTime->isPast();

          return view('components.data-tables.online_order_information', compact('data', 'estiationStatus'));
        })
        ->rawColumns(['actions', 'order_status', 'payment_status', 'reservation_status', 'information'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.online_order.online_order', compact('transaction'));
  }

  /**
   * mengembalikan detail pesanan online
   * @return $order
   */
  public function detailOnlineOrder($id)
  {
    $order = OnlineOrder::with(['user', 'order_items', 'order_items.food', 'payment', 'reservation', 'reservation.reservation_items', 'reservation.reservation_items.table'])->findOrFail($id);

    return response()->json([
      'message' => 'Data pesanan',
      'data' => $order
    ]);
  }

  /**
   * proses terima pesanan online order pada dashboard admin
   */
  public function acceptOnlineOrder(OnlineOrder $order)
  {
    try {
      // Update status 'process'
      $order->update(['status' => 'process']);

      if ($order->reservation) {
        Reservation::where('reservation_id', $order->reservation->reservation_id)->first()->update(['reservation_status' => 'process']);
      }

      return response()->json([
        'message' => 'Berhasil terima pesanan!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal terima pesanan!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses tolak pesanan online order pada dashboard admin
   */
  public function rejectedOnlineOrder(OnlineOrder $order)
  {
    try {
      // Update status 'failed'
      $order->update(['status' => 'failed']);

      if ($order->payment->payment_status != 'success') {
        Payment::where('payment_id', $order->payment->payment_id)->first()->update(['payment_status' => 'failed']);
      }

      if ($order->reservation) {
        Reservation::where('reservation_id', $order->reservation->reservation_id)->first()->update(['reservation_status' => 'failed']);
      }

      return response()->json([
        'message' => 'Berhasil tolak pesanan!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal tolak pesanan!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses selesaikan pesanan online order payment cash pada dashboard admin
   */
  public function doneOrderWithPaymentCash(OnlineOrder $order)
  {
    try {
      // Update status 'success'
      $order->update(['status' => 'success']);

      // Update payment 
      Payment::where('online_order_id', $order->online_order_id)->first()
        ->update(['payment_status' => 'success']);

      // update reservasi jika ada
      if ($order->reservation) {
        $finish = (Carbon::now()->addMinutes(30))->toTimeString();
        Reservation::where('reservation_id', $order->reservation->reservation_id)->first()
          ->update(
            [
              'reservation_status' => 'success',
              'visit_time' => Carbon::now()->toTimeString(),
              'finished_time' => $finish,
            ]
          );
      }

      return response()->json([
        'message' => 'Pesanan berhasil!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses selesaikan payment pesanan online pada dashboard admin
   */
  public function donePayment(OnlineOrder $order)
  {
    try {
      // Update payment 
      Payment::where('online_order_id', $order->online_order_id)->first()
        ->update(['payment_status' => 'success']);

      return response()->json([
        'message' => 'Pembayaran pesanan selesai!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses menampilkan bukti pembayaran
   * @return report bukti pembayaran 
   */
  public function payment(OnlineOrder $order)
  {
    Date::setLocale('id');
    $dateNow = Carbon::now()->translatedFormat('l, d F Y');

    $pdf = PDF::setOptions([
      'isHtml5ParserEnabled' => true,
      'isRemoteEnabled' => true,
    ])
      ->setPaper(
        array(0, 0, 935.433, 609.449),
        'portrait'
      )
      ->loadview('home.report.payment', compact(['dateNow', 'order']));

    return $pdf->stream('bukti_pembayaran' . random_int(0000, 9999) . ".pdf");
  }
}
