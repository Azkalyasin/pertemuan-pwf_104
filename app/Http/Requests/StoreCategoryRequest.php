<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        // Hanya admin yang boleh mengelola kategori (sesuai Gate nanti)
        return true; 
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:category,name', // Nama kategori wajib diisi, unik di tabel category
        ];
    }

    /**
     * Pesan error kustom.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada.',
        ];
    }
}
