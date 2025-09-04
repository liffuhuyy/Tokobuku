<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Tambahkan data kategori di sini
        \App\Models\Kategori::create(['kategori' => 'Fiksi', 'jenis' => 'Novel']);
        \App\Models\Kategori::create(['kategori' => 'Non-Fiksi', 'jenis' => 'Biografi']);
        \App\Models\Kategori::create(['kategori' => 'Ilmiah', 'jenis' => 'Teknologi']);
        \App\Models\Kategori::create(['kategori' => 'Anak-anak', 'jenis' => 'Cerita Bergambar']);
        \App\Models\Kategori::create(['kategori' => 'Komik', 'jenis' => 'Manga']);
    }
}
