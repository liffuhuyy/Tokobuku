<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{
    protected $table = 'databuku';

    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'cover_buku',
        'penerbit',
        'pengarang',
        'kategori',
        'tahun_terbit',
    ];

    // Relasi dengan model Kategori (jika diperlukan)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'kategori');
    }

    // Relasi dengan model Harga (jika diperlukan)
    public function harga()
    {
        return $this->hasOne(Harga::class, 'buku_id', 'id');
    }
}
