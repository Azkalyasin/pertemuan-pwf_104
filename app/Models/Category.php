<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Nama tabel di database (sesuai gambar: 'category')
    protected $table = 'category';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'name', // Nama kategori
    ];

    /**
     * Relasi ke model Product
     */
    public function products()
    {
        // Satu kategori memiliki banyak produk
        return $this->hasMany(Product::class);
    }
}
