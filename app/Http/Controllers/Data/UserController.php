<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $query = User::query();

            // Select
            if ($request->role != 'select') {
                $query = User::query()->where('role', $request->role);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.button_actions')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.data_master.user.user', compact('transaction'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            'message' => 'Data user',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update(['role' => $request->status]);

        return response()->json(['message' => 'Berhasil ubah status pengguna'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Berhasil hapus pengguna'], 200);
    }
}
