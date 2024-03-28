<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderCheckoutController extends Controller
{
  /**
   * Menampilkan halaman checkout
   */
  public function index()
  {
    $carts = CartItem::with('food')->where('user_id', auth()->user()->id)->where('status', 'pending')->get();
    $checkoutItems = CartItem::with('food')->where('user_id', auth()->user()->id)->where('status', 'process')->get();

    return view('home.checkout', compact(['carts', 'checkoutItems']));
  }

  /**
   * Cek cart items yang status nya process untuk proses checkout
   */
  public function getCheckout()
  {
    $checkoutItems = CartItem::with('food')->where('user_id', auth()->user()->id)->where('status', 'process')->get();

    return response()->json([
      'message' => 'Cart items in process status for checkout',
      'data' => $checkoutItems,
    ]);
  }

  /**
   * proses checkout - order online
   * @return view modal-body-online-order-checkout-in-reservation
   */
  public function checkout(Request $request)
  {
    if ($request->reservation_id) {
      // order pada reservation
      $items = CartItem::with('food')->whereIn('id', $request->cart_items)->get();
      $html = view('components.home.modal.body.modal-body-online-order-checkout-in-reservation', compact(['items']))->render();

      return response()->json([
        'message' => 'Checkout berhasil',
        'html' => $html,
      ]);
    } else {
      $items = CartItem::with('food')->whereIn('id', $request->cart_items)->update(['status' => 'process']);

      return response()->json([
        'message' => 'Checkout berhasil',
        'data' => $items,
      ]);
    }
  }

  /**
   * proses rollback checkout
   */
  public function rollbackCheckout(Request $request)
  {
    $items = CartItem::with('food')->whereIn('id', $request->cart_items)->delete();

    return response()->json([
      'message' => 'Rollback checkout berhasil',
      'data' => $items
    ]);
  }
}
