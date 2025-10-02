<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $table = 'harga';
    protected $fillable = ['buku_id', 'harga', 'stok'];

    public function buku()
    {
        return $this->belongsTo(DataBuku::class, 'buku_id', 'id');
    }
}
