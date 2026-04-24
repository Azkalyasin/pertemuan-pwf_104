<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Nama tabel di database (sesuai gambar: 'product')
    protected $table = 'product';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',        // Nama produk
        'quantity',    // Jumlah produk (tipe data string sesuai gambar)
        'price',       // Harga produk
        'user_id',     // ID pengguna pemilik produk
        'category_id', // ID kategori produk
    ];

    /**
     * Relasi ke model User (Pemilik Produk)
     */
    public function user()
    {
        // Setiap produk dimiliki oleh satu user
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Category
     */
    public function category()
    {
        // Setiap produk termasuk dalam satu kategori
        return $this->belongsTo(Category::class);
    }
}
