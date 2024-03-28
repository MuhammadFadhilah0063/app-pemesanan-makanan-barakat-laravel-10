<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Category::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', 'components.data-tables.button_actions_category')
                ->rawColumns(['actions'])
                ->make(true);
        }

        // Badge transaksi pending and success
        $transaction = transactionBadges();

        return view('dashboard.data_master.category.category', compact('transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'slug' => 'required|unique:categories',
            ],
            [
                'name.required' => 'Kategori harus diisi!',
                'slug.required' => 'Slug harus diisi!',
                'slug.unique' => 'Slug sudah ada!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {
            Category::create([
                'name' => Str::of($request->name)->trim(),
                'slug' => $request->slug,
            ]);

            return response()->json([
                'message' => 'Berhasil ditambah',
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json([
            'message' => 'Data category',
            'data' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'slug' => [
                    'required',
                    Rule::unique('categories')->ignore($id)
                ],
            ],
            [
                'name.required' => 'Kategori harus diisi!',
                'slug.required' => 'Slug harus diisi!',
                'slug.unique' => 'Slug sudah ada!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ], 400);
        } else {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => Str::of($request->name)->trim(),
                'slug' => $request->slug,
            ]);

            return response()->json([
                'message' => 'Berhasil diubah',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Berhasil dihapus',
        ], 200);
    }
}
