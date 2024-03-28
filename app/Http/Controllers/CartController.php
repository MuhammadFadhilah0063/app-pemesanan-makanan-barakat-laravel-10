<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
  /**
   * proses tambah cart item baru dan tambah quantity - ketika btn (+) diklik pada list menu dan list cart
   */
  public function addToCart(Request $request)
  {
    $cart = CartItem::where('food_id', $request->food_id)->where('user_id', $request->user_id)->where('status', 'pending')->first();

    if ($cart) {
      // jika ada request quantity 
      if ($request->quantity) {
        $cart->update([
          'quantity' => $request->quantity
        ]);
      } else {
        // Jika item sudah ada - tambah quantity saja
        $cart->update([
          'quantity' => ($cart->quantity + 1)
        ]);
      }

      return response()->json([
        'message' => 'Jumlah item berhasil diubah',
        'data' => $cart
      ], 200);
    } else {
      // Jika tidak ada tambah baru
      $cart = CartItem::create([
        'food_id' => $request->food_id,
        'user_id' => $request->user_id,
        'price' => $request->price,
        'quantity' => 1,
      ]);

      return response()->json([
        'message' => 'Menu berhasil ditambahkan ke dalam keranjang',
        'data' => $cart
      ], 200);
    }
  }

  /**
   * proses menghapus cart item dan mengurangi quantity - ketika btn (-) diklik pada list cart
   */
  public function reduceToCart(Request $request)
  {
    $cart = CartItem::where('food_id', $request->food_id)->where('user_id', $request->user_id)->where('status', 'pending')->first();

    // Jika quantity == 0 - hapus cart item
    if ($cart->quantity == 0) {
      $cart->delete();

      return response()->json([
        'message' => 'Item berhasil dihapus',
        'data' => $cart
      ], 200);
    } else {
      // Jika quantity > 0 - kurangi quantity
      $cart->update([
        'quantity' => ($cart->quantity - 1)
      ]);

      return response()->json([
        'message' => 'Jumlah item berhasil diubah',
        'data' => $cart
      ], 200);
    }
  }
}
