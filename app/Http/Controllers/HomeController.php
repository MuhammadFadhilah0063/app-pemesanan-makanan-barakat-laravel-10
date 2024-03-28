<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * menampilkan halaman home
   */
  public function index(Request $request)
  {
    $categories = Category::get();
    $food = Food::with('category')->orderBy('created_at', 'desc')->get();

    if (request()->ajax()) {
      if (auth()->user()) {
        $carts = CartItem::with('food')->where('user_id', auth()->user()->id)->where('status', 'pending')->get();
        $dropdownLayout = 'dropdown-menu-xl-end';

        return view('components.home.navbar.cart', compact(['carts', 'dropdownLayout']))->render();
      } else {
        // reload logout
        return view('home.index', compact(['categories', 'food']));
      }
    }

    if (auth()->user()) {
      $carts = CartItem::with('food')->where('user_id', auth()->user()->id)->where('status', 'pending')->get();
      return view('home.index', compact(['carts', 'categories', 'food']));
    }

    return view('home.index', compact(['categories', 'food']));
  }
}
