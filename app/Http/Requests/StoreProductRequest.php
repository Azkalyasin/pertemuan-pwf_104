<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        // Izinkan semua user yang sudah terautentikasi
        return true;
    }

    /**
     * Ambil aturan validasi yang berlaku untuk request ini.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Nama wajib diisi, string, maks 255
            'quantity' => 'required|string', // Kuantitas wajib diisi, string (sesuai gambar)
            'price' => 'required|numeric', // Harga wajib diisi, angka
            'user_id' => 'required|exists:users,id', // User ID wajib diisi, harus ada di tabel users
            'category_id' => 'required|exists:category,id', // Category ID wajib diisi, harus ada di tabel category
        ];
    }

    /**
     * Pesan error kustom untuk validator.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'user_id.required' => 'Pemilik produk wajib dipilih.',
            'user_id.exists' => 'Pemilik yang dipilih tidak valid.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ];
    }
}
