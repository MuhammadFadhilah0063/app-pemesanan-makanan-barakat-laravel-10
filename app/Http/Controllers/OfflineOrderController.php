<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Food;
use App\Models\OfflineOrder;
use App\Models\OfflineOrderItem;
use App\Models\Payment;
use App\Models\Table;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class OfflineOrderController extends Controller
{
  /**
   * menampilkan halaman offline order berdasarkan nomor meja
   */
  public function index(Request $request, $id)
  {
    $table = Table::with('user')->find($id);

    // request ajax
    if (request()->ajax()) {
      $carts = CartItem::with('food')->where('user_id', $table->user->id)->where('status', 'pending')->get();
      $dropdownLayout = 'dropdown-menu-end';

      return view('components.home.navbar.cart', compact(['carts', 'dropdownLayout']))->render();
    }

    // Kosongkan cart items
    CartItem::where('user_id', $table->user->id)->where('status', 'pending')->delete();

    $categories = Category::get();
    $food = Food::with('category')->get();
    $carts = CartItem::where('user_id', $table->user->id)->where('status', 'pending')->get();

    return view('home.offline-order', compact(['categories', 'food', 'table', 'carts']));
  }

  /**
   * proses render modal checkout order pada halaman offline order
   * @return view modal-body-offline-order-checkout
   */
  public function modalCheckout(Request $request)
  {
    $items = CartItem::with('food')->whereIn('id', $request->cart_items)->get();
    $table = Table::with(['user'])->where('id', $request->table_id)->first();
    $order = OfflineOrder::where('user_id', $table->user->id)->where('status', 'process')->latest()->first();

    if ($order) {
      return view('components.home.modal.body.modal-body-offline-order-checkout', compact(['items', 'order']))->render();
    } else {
      $order = '';
      return view('components.home.modal.body.modal-body-offline-order-checkout', compact(['items', 'order']))->render();
    }
  }

  /**
   * proses order
   */
  public function order(Request $request)
  {

    DB::transaction(function () use ($request) {

      $table = Table::where('id', $request->table_id)->first();
      $items = CartItem::whereIn('id', $request->items_id)->get();
      $order = OfflineOrder::where('user_id', $table->user->id)->where('status', 'process')->latest()->first();

      // set status cart item to success
      CartItem::whereIn('id', $request->items_id)->update(['status' => 'process']);

      if ($order) {
        // Tambah pesanan
        $order->update([
          'total' => intval($order->total) + intval($request->total),
        ]);
      } else {
        // Pesanan baru
        $orderId = makeId('OFD');

        // Create order
        OfflineOrder::create([
          'offline_order_id' => $orderId,
          'name' => $request->name,
          'total' => $request->total,
          'user_id' => $table->user->id,
        ]);
      }

      // Create order items
      foreach ($items as $item) {
        OfflineOrderItem::create([
          'offline_order_id' => ($order) ? $order->offline_order_id : $orderId,
          'food_id' => $item->food_id,
          'quantity' => $item->quantity,
          'price' => $item->price,
        ]);
      }
    });

    return response()->json([
      'message' => 'success',
    ], 200);
  }

  /**
   * proses render modal order baru-baru ini pada halaman offline order
   * @return view modal-body-offline-order
   */
  public function getOrderRecently(Table $table)
  {
    $order = '';
    $order = OfflineOrder::with(['order_items', 'order_items.food', 'payment'])->where('user_id', $table->user->id)->where('status', 'process')->latest()->first();

    if (!$order) {
      $order = OfflineOrder::with(['order_items', 'order_items.food', 'payment'])->where('user_id', $table->user->id)->latest()->first();
    }

    return view('components.home.modal.body.modal-body-offline-order', compact(['order']))->render();
  }

  /**
   * proses selesaikan atau tutup order dan render ulang modal order
   * @return view modal-body-offline-order
   */
  public function closeOrder($id)
  {
    $order = OfflineOrder::with(['user', 'payment'])->where('offline_order_id', $id)->first();

    $order->update(['status' => 'success']);

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
        'order_id'      => $order->offline_order_id,
        'gross_amount'  => $order->total,
      ],
      'customer_details' => [
        'first_name'       => $order->name,
        'username'         => $order->user->username,
      ]
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    $order->update([
      'snap_token' => $snapToken
    ]);

    // Create payment
    Payment::create([
      'payment_id' => makeId('PYM'),
      'offline_order_id' => $order->offline_order_id,
    ]);

    $order = OfflineOrder::with(['user', 'payment'])->where('offline_order_id', $id)->first();

    return view('components.home.modal.body.modal-body-offline-order', compact(['order']))->render();
  }

  // Admin
  /**
   * menampilkan halaman online order pada dashboard admin
   */
  public function indexOfflineOrder()
  {

    if (request()->ajax()) {
      $query = OfflineOrder::with(['payment'])->latest();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_offline_order')
        ->addColumn('order_status', 'components.data-tables.order_status')
        ->addColumn('payment_status', 'components.data-tables.payment_status')
        ->rawColumns(['actions', 'order_status', 'payment_status'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.offline_order.offline_order', compact('transaction'));
  }

  /**
   * @return data order
   */
  public function detailOfflineOrder($id)
  {
    $order = OfflineOrder::with(['user', 'order_items', 'order_items.food', 'payment'])->findOrFail($id);

    return response()->json([
      'message' => 'Data pesanan',
      'data' => $order
    ]);
  }

  /**
   * proses tolak atau batalkan pesanan offline order pada dashboard admin
   */
  public function rejectedOfflineOrder(OfflineOrder $order)
  {
    try {
      // Update status 'failed'
      $order->update(['status' => 'failed']);

      return response()->json([
        'message' => 'Pesanan berhasil dibatalkan!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Pesanan gagal dibatalkan!',
        'errors' => $err
      ], 300);
    }
  }

  /**
   * proses tutup pesanan offline order pada dashboard admin
   */
  public function closeOrderInDashboard(OfflineOrder $order)
  {
    try {
      $order = OfflineOrder::with(['user', 'payment'])->where('offline_order_id', $order->offline_order_id)->first();

      // Update status 'success'
      $order->update(['status' => 'success']);

      // Create payment
      Payment::create([
        'payment_id' => makeId('PYM'),
        'offline_order_id' => $order->offline_order_id,
        'payment_status' => 'success',
      ]);

      return response()->json([
        'message' => 'Berhasil tutup pesanan!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal tutup pesanan!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses terima pembayaran tunai pesanan offline order pada dashboard admin
   */
  public function paymentAccept(OfflineOrder $order)
  {
    try {
      $payment = Payment::where('offline_order_id', $order->offline_order_id)->first();

      // Update status pembayaran 'success'
      $payment->update(['payment_status' => 'success']);

      return response()->json([
        'message' => 'Berhasil terima pembayaran tunai!',
        'data' => $order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal terima pembayaran tunai!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses menampilkan bukti pembayaran
   * @return report bukti pembayaran 
   */
  public function payment(OfflineOrder $order)
  {
    $pdf = PDF::setOptions([
      'isHtml5ParserEnabled' => true,
      'isRemoteEnabled' => true,
    ])
      ->setPaper(
        array(0, 0, 935.433, 609.449),
        'portrait'
      )
      ->loadview('home.report.payment-offline', compact(['order']));

    return $pdf->stream('bukti_pembayaran' . random_int(0000, 9999) . ".pdf");
  }
}
