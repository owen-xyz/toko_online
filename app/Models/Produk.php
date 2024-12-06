<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk factory

    // Menentukan apakah tabel menggunakan timestamp atau tidak
    public $timestamps = true;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'produk';

    // Melindungi kolom 'id' dari mass assignment
    protected $guarded = ['id'];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class); // Relasi 'produk' ke 'kategori' menggunakan belongsTo
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi 'produk' ke 'user' menggunakan belongsTo
    }
}
