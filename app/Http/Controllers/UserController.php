<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category; // Model Produk
use App\About;    // Model Tentang Toko

class UserController extends Controller
{
  /**
   * Halaman Utama (Home)
   */
  public function index()
  {
    // 1. Ambil data Tentang Toko
    $about = About::first();

    // 2. Ambil Data Kategori & Kelompokkan
    // PERBAIKAN DISINI: Ganti 'unique' menjadi 'groupBy'
    // groupBy akan mengumpulkan semua barang berdasarkan nama grupnya.
    $categories = Category::latest()->get()->groupBy('group');

    return view('user.home', compact('categories', 'about'));
  }

  /**
   * Halaman Detail Kategori
   */
  public function categoryDetail($id)
  {
    // 1. Cari produk yang diklik
    $clickedProduct = Category::findOrFail($id);

    // 2. Ambil nama grupnya (Misal: "Semen")
    $groupName = $clickedProduct->group;

    // 3. Ambil SEMUA produk lain yang memiliki group sama
    $products = Category::where('group', $groupName)->latest()->get();

    // 4. Kirim data ke view detail
    return view('user.category_detail', [
      'group_name' => $groupName,
      'products'   => $products,
      'sample'     => $clickedProduct
    ]);
  }
}
