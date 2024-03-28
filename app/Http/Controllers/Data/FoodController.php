<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FoodController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $categories = Category::get();

    if (request()->ajax()) {
      $query = Food::with('category');

      if ($request->filter) {
        $data = Str::of($request->filter)->explode('-');
        $value = intval($data[0]);
        $filter = $data[1];

        $query->where($filter, $value);
      }

      return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('actions', '.components.data-tables.button_actions_menu')
        ->addColumn('ready_btn', 'components.data-tables.button_status_menu')
        ->addColumn('image', 'components.data-tables.image')
        ->rawColumns(['actions', 'image', 'ready_btn'])
        ->make(true);
    }

    // Badge transaksi pending and success
    $transaction = transactionBadges();

    return view('dashboard.data_master.menu.menu', compact(['categories', 'transaction']));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validation = Validator::make(
      $request->all(),
      [
        'name'          => 'required',
        'slug'          => 'required|unique:food',
        'category_id'   => 'required',
        'price'         => 'required|numeric',
        'image'         => 'sometimes|image|mimes:jpeg,jpg,png|max:2000',
      ],
      [
        'name.required'  => 'Nama menu harus diisi!',
        'slug.required'  => 'Slug harus diisi!',
        'slug.unique'    => 'Slug sudah ada!',
        'category_id.required' => 'Kategori harus dipilih!',
        'price.required' => 'Harga harus diisi!',
        'price.numeric'  => 'Harga harus diisi angka!',
        'image.image'    => 'File harus berupa gambar!',
        'image.mimes'    => 'Format gambar yang diperbolehkan adalah JPEG, JPG, dan PNG!',
        'image.max'      => 'Ukuran gambar maksimal adalah 2MB!',
      ]
    );

    if ($validation->fails()) {
      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        // Ambil image
        if ($request->file('image')) {
          // Ambil data image
          $imageName = $request->file('image')->hashName();
          $image = $request->file('image');

          // Simpan image
          $image->storeAs('public/image/food', $imageName);
        } else {
          $imageName = 'img.png';
        }

        $food = Food::create([
          'category_id' => $request->category_id,
          'name' => $request->name,
          'slug' => $request->slug,
          'image' => $imageName,
          'description' => $request->description,
          'price' => $request->price,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil tambah menu baru',
        'data' => $food
      ], 200);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $food = Food::where('food_id', $id)->firstOrFail();

    return response()->json([
      'message' => 'Data menu',
      'data' => $food,
    ], 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validation = Validator::make(
      $request->all(),
      [
        'name'          => 'required',
        'slug'          => 'required|unique:App\Models\Food,food_id',
        'category_id'   => 'required',
        'price'         => 'required|numeric',
        'image'         => 'sometimes|image|mimes:jpeg,jpg,png|max:2000',
      ],
      [
        'name.required'  => 'Nama menu harus diisi!',
        'slug.required'  => 'Slug harus diisi!',
        'slug.unique'    => 'Slug sudah ada!',
        'category_id.required' => 'Kategori harus dipilih!',
        'price.required' => 'Harga harus diisi!',
        'price.numeric'  => 'Harga harus diisi angka!',
        'image.image'    => 'File harus berupa gambar!',
        'image.mimes'    => 'Format gambar yang diperbolehkan adalah JPEG, JPG, dan PNG!',
        'image.max'      => 'Ukuran gambar maksimal adalah 2MB!',
      ]
    );

    if ($validation->fails()) {

      return response()->json([
        'errors' => $validation->errors()
      ], 400);
    } else {

      try {
        $food = Food::findOrFail($id);

        // Ambil image - jika ada image
        if ($request->file('image')) {
          // Ambil data image
          $imageName = $request->file('image')->hashName();
          $image = $request->file('image');

          // Hapus image lama
          if ($food->image != asset('storage/image/food/img.png')) {
            Storage::disk('local')->delete('public/image/food/' . basename($food->image));
          }

          // Simpan image baru
          $image->storeAs('public/image/food', $imageName);

          // update image food
          $food->update([
            'image' => $imageName,
          ]);
        }

        // update food
        $food->update([
          'category_id' => $request->category_id,
          'name' => $request->name,
          'slug' => $request->slug,
          'description' => $request->description,
          'price' => $request->price,
        ]);
      } catch (QueryException $e) {
        return response()->json([
          'error' => $e
        ], 400);
      }

      return response()->json([
        'message' => 'Berhasil ubah menu',
        'data' => $food
      ], 200);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $food = Food::findOrFail($id);

    // Hapus image lama
    if ($food->image != asset('storage/image/food/img.png')) {
      Storage::disk('local')->delete('public/image/food/' . basename($food->image));
    }

    $food->delete();

    return response()->json([
      'message' => 'Berhasil dihapus',
      'data' => $food,
    ], 200);
  }

  /**
   * Update status ready menu
   */
  public function updateReady(Request $request, $id)
  {
    try {
      Food::where('food_id', $id)
        ->update(['ready' => ($request->ready === '1') ? 0 : 1]);

      $pesanStatus = ($request->ready === '1') ? 'habis' : 'ada';

      return response()->json([
        'message' => "Berhasil ubah status menu menjadi $pesanStatus",
      ], 200);
    } catch (QueryException $err) {
      return response()->json([
        'message' => 'Gagal merubah status',
        'error' => $err
      ], 400);
    }
  }
}
