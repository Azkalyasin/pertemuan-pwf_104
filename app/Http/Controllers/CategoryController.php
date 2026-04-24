<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori (index).
     */
    public function index()
    {
        // Ambil semua kategori beserta jumlah produk yang terkait (withCount)
        // Ini memenuhi syarat "menampilkan total product" di tabel
        $categories = Category::withCount('products')->get();

        // Kirim data ke view category.index
        return view('category.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori (create).
     */
    public function create()
    {
        // Tampilkan view form tambah
        return view('category.create');
    }

    /**
     * Menyimpan kategori baru ke database (store).
     */
    public function store(StoreCategoryRequest $request)
    {
        // Ambil data yang sudah divalidasi dari request
        $validated = $request->validated();

        // Simpan ke tabel category
        Category::create($validated);

        // Redirect kembali ke index dengan pesan sukses
        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kategori (edit).
     */
    public function edit(Category $category)
    {
        // Kirim data kategori yang akan diedit ke view
        return view('category.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori (update).
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Ambil data divalidasi
        $validated = $request->validated();

        // Perbarui data kategori
        $category->update($validated);

        // Redirect ke index
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (destroy).
     */
    public function destroy(Category $category)
    {
        // Hapus data kategori (relasi di DB akan menangani cascade delete produk jika ada)
        $category->delete();

        // Redirect ke index
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
