<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $carts = CartItem::with('food')
            ->where('user_id', auth()->user()->id)->where('status', 'pending')
            ->get();


        return view('home.profile', compact(['carts']));
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $html = view('components.home.profile.body_form_profile', compact(['user']))->render();

        return response()->json([
            'message' => 'Berhasil ubah profile',
            'data' => $user,
            'html' => $html,
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        $newPassword = $request->new_password;
        $oldPassword = $request->old_password;

        if (Hash::check($oldPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($newPassword),
            ]);

            return response()->json([
                'message' => 'Berhasil ubah password',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gagal ubah password',
            ], 400);
        }
    }
}
