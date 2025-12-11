<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \App\Category::paginate(10);
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        Validator::make($request->all(), [
            'name'          => 'required|min:2|max:20',
            'code'          => 'required|unique:categories,code',
            'group'         => 'required|min:2',
            'stock'         => 'nullable|integer|min:0',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ])->validate();

        $category = new \App\Category();
        $category->name = $request->get('name');
        $category->group = $request->get('group');
        $category->code = $request->get('code');
        $category->stock = $request->get('stock') ?? 0;
        $category->description = $request->get('description');

        if ($request->file('image')) {
            $nama_file = time() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('category_image'), $nama_file);
            $category->image = $nama_file;
        }

        $category->slug = Str::slug($request->get('name'));

        // FIX FATAL ERROR SQL 1054: created_by dinonaktifkan karena kolom tidak ada di DB
        // $category->created_by = Auth::id(); 

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Method ini tidak digunakan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = \App\Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = \App\Category::findOrFail($id);
        // ... (Validasi & Update Logic) ...
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = \App\Category::findOrFail($id);
        if ($category->image) {
            File::delete(public_path('category_image/' . $category->image));
        }
        $category->forceDelete();
        return redirect()->route('categories.index')->with('success', 'Produk berhasil dihapus.');
    }

    // --- Metode tambahan (restore, deletePermanent, ajaxSearch) ---

    public function restore($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);
        $category->restore();
    }

    public function deletePermanent($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);
        if ($category->image) {
            File::delete(public_path('category_image/' . $category->image));
        }
        $category->forceDelete();
        return redirect()->route('categories.index')->with('success', 'Category successfully deleted.');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $categories = \App\Category::where('name', 'Like', "%$keyword%")->get();
        return $categories;
    }
}
