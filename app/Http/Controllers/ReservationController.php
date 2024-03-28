<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cash;
use App\Models\Category;
use App\Models\Food;
use App\Models\OnlineOrder;
use App\Models\OnlineOrderItem;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\ReservationItem;
use App\Models\Table;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ReservationController extends Controller
{
  protected $reservation;

  /**
   * menampilkan halaman reservation
   */
  public function index(Request $request)
  {
    if (request()->ajax()) {
      if (auth()->user()) {
        if ($request->status == 'all') {
          $reservations = Reservation::with(['reservation_items', 'online_order', 'online_order.order_items', 'online_order.order_items.food', 'online_order.payment'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('reservation_date', 'DESC')
            ->orderBy('reservation_time', 'DESC')
            ->get();
        } else {
          $reservations = Reservation::with(['reservation_items', 'online_order', 'online_order.order_items', 'online_order.order_items.food', 'online_order.payment'])
            ->where('user_id', auth()->user()->id)
            ->where('reservation_status', $request->status)
            ->orderBy('reservation_date', 'DESC')
            ->orderBy('reservation_time', 'DESC')
            ->get();
        }

        if (count($reservations) == 0) {
          return view('components.home.reservation.reservation-items-empty')->render();
        }

        return view('components.home.reservation.reservation-items', compact(['reservations']))->render();
      }
    }

    $reservations = Reservation::with(['reservation_items', 'online_order', 'online_order.order_items', 'online_order.order_items.food', 'online_order.payment'])
      ->where('user_id', auth()->user()->id)
      ->orderBy('reservation_date', 'DESC')
      ->orderBy('reservation_time', 'DESC')
      ->get();
    $carts = CartItem::with('food')->where('user_id', auth()->user()->id)
      ->where('status', 'pending')
      ->latest()
      ->get();

    return view('home.reservation', compact(['reservations', 'carts']));
  }

  /**
   * proses render modal checkout reservation
   * @return view modal-body-reservation
   */
  public function modalCheckout(Request $request)
  {
    $tables = Table::get();
    $html = view('components.home.modal.body.modal-body-reservation', compact(['tables', 'request']))->render();

    return response()->json([
      'message' => 'Modal body reservation',
      'html' => $html,
    ]);
  }

  /**
   * proses reservation
   */
  public function reservation(Request $request)
  {
    DB::transaction(function () use ($request) {

      $idReservation = makeId('RSV');

      if ($request->order_id) {
        $estimation_time = $request->estimation_time;
      } else {
        $estimation_time = estimationTime($request->reservation_time, $request->estimation_time);
      }

      // Create reservation
      $this->reservation = Reservation::create([
        'reservation_id' => $idReservation,
        'name' => $request->name,
        'phone' => $request->phone,
        'reservation_date' => $request->reservation_date,
        'reservation_time' => $request->reservation_time,
        'estimation_time' => $estimation_time,
        'user_id' => auth()->user()->id,
      ]);

      // Create reservation items
      for ($i = 0; $i < count($request->tables_id); $i++) {
        ReservationItem::create([
          'reservation_id' => $idReservation,
          'table_id' => $request->tables_id[$i]
        ]);
      }

      if ($request->order_id) {
        OnlineOrder::where('online_order_id', $request->order_id)->first()->update([
          'reservation_id' => $idReservation
        ]);
      }
    });

    return response()->json([
      'message' => 'Berhasil',
      'data' => $this->reservation
    ]);
  }

  /**
   * proses accept reservation
   */
  public function accept($id)
  {
    $reservation = Reservation::where('reservation_id', $id)->first();

    DB::beginTransaction();

    // ubah reservation
    $reservation->update(['reservation_status' => 'success']);

    if ($reservation->online_order) {
      // ubah order
      OnlineOrder::where('online_order_id', $reservation->online_order->online_order_id)->first()->update(['status' => 'success']);

      // Ubah payment
      if ($reservation->online_order->payment_method == 'cash') {
        if ($reservation->online_order->payment->payment_status == 'pending') {
          Payment::where('payment_id', $reservation->online_order->payment->payment_id)->first()->update(['payment_status' => 'success']);

          $cash = Cash::where('id', 1)->first();
          $cash->addCash($reservation->online_order->total);
        }

        DB::commit();
      } else {

        if ($reservation->online_order->payment->payment_status == 'pending') {
          DB::rollBack();

          return response()->json([
            'status' => 'Gagal',
            'message' => 'Tolong selesaikan pembayaran dahulu!',
          ], 200);
        }
      }
    }

    DB::commit();

    return response()->json([
      'message' => 'Berhasil',
      'data' => $reservation,
    ], 200);
  }

  /**
   * proses cancel reservation
   */
  public function cancel($id)
  {
    $reservation = Reservation::where('reservation_id', $id)->first();

    // ubah reservation
    $reservation->update(['reservation_status' => 'failed']);

    if ($reservation->online_order) {
      // ubah order
      $order = OnlineOrder::with(['payment'])->where('online_order_id', $reservation->online_order->online_order_id)->first();
      $order->update(['status' => 'failed']);

      // ubah payment
      $payment = Payment::where('payment_id', $order->payment->payment_id)->first();
      if ($payment->payment_status == 'pending') {
        $payment->update(['payment_status' => 'failed']);
      }
    }

    return response()->json([
      'message' => 'Berhasil',
    ], 200);
  }

  /**
   * menampilkan halaman reservation order
   */
  public function orderIndex(Reservation $reservation)
  {
    // request ajax
    if (request()->ajax()) {
      $carts = CartItem::with('food')->where('user_id', $reservation->user_id)->where('status', 'pending')->get();
      $dropdownLayout = 'dropdown-menu-end';

      return view('components.home.navbar.cart', compact(['carts', 'dropdownLayout']))->render();
    }

    $categories = Category::get();
    $food = Food::with('category')->get();
    $carts = CartItem::where('user_id', $reservation->user_id)->where('status', 'pending')->get();

    return view('home.order-reservation', compact(['categories', 'food', 'reservation', 'carts']));
  }

  /**
   * proses online order pada halaman reservation order
   */
  public function order(Request $request)
  {

    try {
      // Start transaction
      DB::beginTransaction();

      // Ambil Reservation
      $reservation = Reservation::where('reservation_id', $request->reservation_id)->first();

      // Make id order
      $idOrder = makeId('OND');

      // Create order
      $order = OnlineOrder::create([
        'online_order_id' =>  $idOrder,
        'user_id' => auth()->user()->id,
        'name' => $reservation->name,
        'phone' => $reservation->phone,
        'pick_up_date' => $reservation->reservation_date,
        'pick_up_time' => $reservation->reservation_time,
        'estimation_time' => $reservation->estimation_time,
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

      // Create payment
      Payment::create([
        'payment_id' => makeId('PYM'),
        'online_order_id' => $idOrder,
      ]);

      // Delete items from CartItems
      CartItem::whereIn('id', $request->order['order_items_id'])->delete();

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
            'first_name'       => $reservation->name,
            'username'         => auth()->user()->username,
            'phone'            => $reservation->phone,
          ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->update([
          'snap_token' => $snapToken,
          'reservation_id' => $request->reservation_id
        ]);
      }

      // Cash
      $order->update([
        'reservation_id' => $request->reservation_id
      ]);

      // Commit Transaction
      DB::commit();

      return response()->json([
        'message' => 'Success',
        'data' => $order,
      ], 200);
    } catch (QueryException $err) {

      // Rollback Transaction
      DB::rollBack();

      return response()->json([
        'message' => 'Failed',
        'error' => $err,
      ], 400);
    }
  }

  /**
   * menampilkan halaman offline reservation
   */
  public function indexOffline()
  {
    return view('home.offline-reservation');
  }

  /**
   * proses offline reservation
   */
  public function reservationOffline(Request $request)
  {
    $id = makeId('ROF');
    $reservation = Reservation::create([
      'reservation_id' => $id,
      'name' => $request->name,
      'waiting' => 1,
      'reservation_date' => Carbon::now()->toDateString(),
      'reservation_time' => Carbon::now()->toTimeString(),
    ]);

    return response()->json([
      'message' => 'Berhasil',
      'data' => $reservation,
    ]);
  }


  // Admin
  /**
   * menampilkan halaman online reservasi pada dashboard admin
   */
  public function indexOnlineReservation()
  {
    if (request()->ajax()) {
      $query =  Reservation::with(['online_order', 'online_order.payment'])
        ->where('reservation_id', 'LIKE', 'RSV%')
        ->where('waiting', 0)
        ->orderBy('reservation_date', 'DESC')
        ->orderBy('reservation_time', 'DESC');

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_online_reservation')
        ->addColumn('reservation_status', 'components.data-tables.reservation_status')
        ->addColumn('payment_status', 'components.data-tables.online_reservation_payment_status')
        ->addColumn('order_status', 'components.data-tables.online_reservation_order_status')
        ->addColumn('information', function ($data) {
          $estimatedTime = Carbon::parse($data->reservation_date . $data->estimation_time);
          $currentDateTime = Carbon::now();

          $timeDifference = $estimatedTime->diff($currentDateTime);

          $estiationStatus = $estimatedTime->isPast();

          return view('components.data-tables.online_reservation_information', compact('data', 'estiationStatus'));
        })
        ->rawColumns(['actions', 'reservation_status', 'payment_status', 'order_status', 'information'])
        ->make(true);
    }

    // ubah status = failed, ketika bukan tgl hari ini dan status masih pending
    $reservation = Reservation::where('reservation_id', 'LIKE', 'RSV%')
      ->whereNot('reservation_date', date('Y-m-d'))
      ->where('reservation_status', 'pending')
      ->get();

    for ($i = 0; $i < count($reservation); $i++) {
      $res = Reservation::where('reservation_id', $reservation[$i]->reservation_id)->first();
      $res->update(['reservation_status' => 'failed']);

      // update order
      if ($res->online_order) {
        OnlineOrder::where('reservation_id', $res->reservation_id)->first()->update(['status' => 'failed']);

        // update payment
        if ($res->online_order->payment) {
          Payment::where('online_order_id', $res->online_order->online_order_id)->first()->update(['payment_status' => 'failed']);
        }
      }
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.online_reservation.online_reservation', compact('transaction'));
  }

  /**
   * mengembalikan data reservation
   * @return $reservation
   */
  public function detailOnlineReservation($id)
  {
    $reservation = Reservation::with(['online_order', 'online_order.order_items', 'online_order.order_items.food', 'online_order.payment', 'reservation_items', 'reservation_items.table'])->where('reservation_id', $id)->first();

    return response()->json([
      'message' => 'Data reservasi',
      'data' => $reservation
    ]);
  }

  /**
   * proses terima reservasi online order pada dashboard admin
   */
  public function acceptOnlineReservation(Reservation $reservation)
  {
    try {
      // Update status 'process'
      $reservation->update(['reservation_status' => 'process']);

      if ($reservation->online_order) {
        OnlineOrder::where('online_order_id', $reservation->online_order->online_order_id)->first()->update(['status' => 'process']);
      }

      return response()->json([
        'message' => 'Berhasil terima reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal terima reservasi!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses tolak reservasi online order pada dashboard admin
   */
  public function rejectedOnlineReservation(Reservation $reservation)
  {
    try {
      // Update status 'failed'
      $reservation->update(['reservation_status' => 'failed']);

      if ($reservation->online_order) {
        $order = OnlineOrder::where('online_order_id', $reservation->online_order->online_order_id)->first();
        $order->update(['status' => 'failed']);
        $payment = Payment::where('payment_id', $order->payment->payment_id)->first();
        if ($payment->payment_status != 'success') {
          $payment->update(['payment_status' => 'failed']);
        }
      }

      return response()->json([
        'message' => 'Berhasil tolak reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal tolak reservasi!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses selesaikan reservasi online order pada dashboard admin
   */
  public function finishOnlineReservation(Reservation $reservation)
  {
    try {
      // Update status 'success'
      $finish = (Carbon::now()->addMinutes(30))->toTimeString();
      $reservation->update([
        'reservation_status' => 'success',
        'visit_time' => Carbon::now()->toTimeString(),
        'finished_time' => $finish,
      ]);

      // update order
      if ($reservation->online_order) {
        $order = OnlineOrder::where('online_order_id', $reservation->online_order->online_order_id)->first();
        $order->update(['status' => 'success']);

        // update payment cash
        if ($order->payment) {
          if ($order->method_payment == 'cash') {
            Payment::where('online_order_id', $order->online_order_id)->first()
              ->update(['payment_status' => 'success']);
          }
        }
      }

      return response()->json([
        'message' => 'Berhasil selesaikan reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal selesaikan reservasi!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses selesaikan payment pesanan online di reservasi online pada dashboard admin
   */
  public function donePayment(Reservation $reservation)
  {
    try {
      // Update payment 
      Payment::where('online_order_id', $reservation->online_order->online_order_id)->first()
        ->update(['payment_status' => 'success']);

      return response()->json([
        'message' => 'Pembayaran pesanan selesai!',
        'data' => $reservation->online_order
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal!',
        'errors' => $err
      ]);
    }
  }



  /**
   * menampilkan halaman offline reservasi pada dashboard admin
   */
  public function indexOfflineReservation()
  {
    if (request()->ajax()) {
      // Ambil reservation hari ini dan urutkan waktu reservasi terdahulu
      $query =  Reservation::where('reservation_id', 'LIKE', 'ROF%')
        ->orderBy('reservation_date', 'desc')
        ->orderBy('reservation_time', 'desc')
        ->orderBy('waiting', 'desc')
        ->orderBy('reservation_time')
        ->latest();

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', 'components.data-tables.button_actions_online_reservation')
        ->addColumn('reservation_status', 'components.data-tables.reservation_status')
        ->addColumn('waiting', 'components.data-tables.reservation_waiting')
        ->rawColumns(['actions', 'reservation_status', 'waiting'])
        ->make(true);
    }

    // ubah status = failed, ketika bukan tgl hari ini dan status masih pending
    Reservation::where('reservation_id', 'LIKE', 'ROF%')
      ->whereNot('reservation_date', date('Y-m-d'))
      ->where('reservation_status', 'pending')
      ->update(['reservation_status' => 'failed', 'waiting' => 0]);

    // ubah status = success, ketika bukan tgl hari ini dan status masih process
    $reservation = Reservation::where('reservation_id', 'LIKE', 'ROF%')
      ->whereNot('reservation_date', date('Y-m-d'))
      ->where('reservation_status', 'process')->get();

    for ($i = 0; $i < count($reservation); $i++) {
      $finish = (Carbon::createFromFormat('H:i:s', $reservation[$i]->visit_time))->addHour(1);

      $res = Reservation::where('reservation_id', $reservation[$i]->reservation_id)->first();
      $res->update([
        'reservation_status' => 'success',
        'waiting' => 0,
        'finished_time' => $finish,
      ]);
    }

    // ubah waiting = 0, jika bukan tgl sekarang
    Reservation::where('reservation_id', 'LIKE', 'ROF%')
      ->whereNot('reservation_date', date('Y-m-d'))
      ->where('waiting', 1)
      ->update(['waiting' => 0]);

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.transaction.offline_reservation.offline_reservation', compact('transaction'));
  }

  /**
   * @return detail data offline reservasi
   */
  public function detailOfflineReservation($id)
  {
    $reservation = Reservation::with(['reservation_items'])->where('reservation_id', $id)->first();

    return response()->json([
      'message' => 'Data reservasi',
      'data' => $reservation
    ]);
  }

  /**
   * proses render modal checkout reservation pada dasbor admin
   * @return view modal-body-offline-reservation
   */
  public function modalCheckoutOffline(Request $request)
  {
    $tables = Table::get();
    $html = view('components.home.modal.body.modal-body-offline-reservation', compact(['tables', 'request']))->render();

    return response()->json([
      'message' => 'Modal body checkout reservasi',
      'html' => $html,
    ]);
  }

  /**
   * proses terima reservasi offline order pada dashboard admin
   */
  public function acceptOfflineReservation(Request $request, Reservation $reservation)
  {
    try {
      // Set zona waktu ke Asia/Makassar
      $visit = Carbon::now()->format('H:i:s');

      // Update status 'process'
      $reservation->update(['reservation_status' => 'process', 'waiting' => 0, 'visit_time' => $visit,]);

      // Create reservation items
      for ($i = 0; $i < count($request->tables_id); $i++) {
        ReservationItem::create([
          'reservation_id' => $reservation->reservation_id,
          'table_id' => $request->tables_id[$i]
        ]);
      }

      return response()->json([
        'message' => 'Berhasil terima reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal terima reservasi!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses selesaikan reservasi offline order pada dashboard admin
   */
  public function finishReservation(Reservation $reservation)
  {
    try {
      // Update status 'success'
      $finish = (Carbon::createFromFormat('H:i:s', $reservation->visit_time))->addHour(1);
      $reservation->update(
        [
          'reservation_status' => 'success',
          'waiting' => 0,
          'finished_time' => $finish,
        ]
      );

      return response()->json([
        'message' => 'Berhasil selesaikan reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal selesaikan reservasi!',
        'errors' => $err
      ]);
    }
  }

  /**
   * proses tolak reservasi offline order pada dashboard admin
   */
  public function rejectedOfflineReservation(Reservation $reservation)
  {
    try {
      // Update status 'failed'
      $reservation->update(['reservation_status' => 'failed', 'waiting' => 0]);

      return response()->json([
        'message' => 'Berhasil tolak reservasi!',
        'data' => $reservation
      ]);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal tolak reservasi!',
        'errors' => $err
      ]);
    }
  }
}
