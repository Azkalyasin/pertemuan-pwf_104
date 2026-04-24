<?php

namespace App\Http\Controllers;

use App\Models\Product; // Menggunakan model Product
use App\Models\User;    // Menggunakan model User
use App\Models\Category; // Menggunakan model Category baru
use App\Http\Requests\StoreProductRequest; // Request validasi tambah
use App\Http\Requests\UpdateProductRequest; // Request validasi edit
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        // Jika admin, tampilkan semua produk dengan relasi user dan category.
        // Jika user biasa, hanya miliknya sendiri.
        if (auth()->user()->isAdmin()) {
            $products = Product::with(['user', 'category'])->get();
        } else {
            $products = Product::with(['user', 'category'])->where('user_id', auth()->id())->get();
        }

        // Kirim ke view index
        return view('product.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        // Ambil semua user untuk pilihan pemilik (jika diperlukan)
        $users = User::orderBy('name')->get();
        // Ambil semua kategori untuk dropdown pilihan kategori
        $categories = Category::orderBy('name')->get();

        // Kirim data ke view
        return view('product.create', compact('users', 'categories'));
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(StoreProductRequest $request)
    {
        // Ambil data tervalidasi
        $validated = $request->validated();

        // Buat produk baru di database
        Product::create($validated);

        // Kembali ke daftar produk dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($id)
    {
        // Cari produk berdasarkan ID atau gagal
        $product = Product::with(['user', 'category'])->findOrFail($id);

        // Tampilkan view detail
        return view('product.view', compact('product'));
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product)
    {
        // Ambil data pendukung untuk dropdown
        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        // Tampilkan form edit
        return view('product.edit', compact('product', 'users', 'categories'));
    }

    /**
     * Memperbarui data produk.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        // Cari produk
        $product = Product::findOrFail($id);

        // Ambil data tervalidasi
        $validated = $request->validated();

        // Update di database
        $product->update($validated);

        // Kembali ke index
        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk.
     */
    public function destroy($id)
    {
        // Cari dan hapus
        $product = Product::findOrFail($id);
        $product->delete();

        // Kembali ke index
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
