<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['kategori', 'jenis'];

    public function kategori()
    {
        return $this->hasMany(DataBuku::class, 'kategori', 'kategori');
    }
}
