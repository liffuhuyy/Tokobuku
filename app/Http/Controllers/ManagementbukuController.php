<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DataBuku;
use App\Models\Kategori;


class ManagementbukuController extends Controller
{
    //admin
    public function index()
    {
        $kategori = Kategori::all();
        $buku = DataBuku::all();
        // Logika untuk menampilkan daftar buku
        return view('admin.management_buku', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'   => 'required',
            'penerbit'     => 'required',
            'pengarang'    => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . date('Y'),
            'cover_buku'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'     => 'required|exists:kategori,id', // pastikan ID valid
        ]);

        // Ambil nama kategori berdasarkan ID
        $kategoriModel = \App\Models\Kategori::find($request->kategori);
        $kategoriName = $kategoriModel->kategori;

        // Ambil huruf pertama nama kategori
        $inisial = strtoupper(mb_substr($kategoriName, 0, 1));

        // Hitung jumlah buku dalam kategori ini
        $count = \App\Models\DataBuku::where('kategori', $kategoriName)->count() + 1;

        // Format nomor urut
        $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);

        // Bentuk kode buku
        $kodeBuku = 'BK' . $inisial . $nomor;

        // Upload cover bila ada
        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $coverPath = $request->file('cover_buku')->store('covers', 'public');
        }

        // Simpan data buku
        \App\Models\DataBuku::create([
            'kode_buku'   => $kodeBuku,
            'judul_buku'  => $request->judul_buku,
            'penerbit'    => $request->penerbit,
            'pengarang'   => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'cover_buku'  => $coverPath,
            'kategori'    => $kategoriName, // simpan nama kategori (bukan ID)
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $buku = DataBuku::findOrFail($id);

        // Hapus file cover jika ada
        if ($buku->cover_buku) {
            Storage::disk('public')->delete($buku->cover_buku);
        }

        $buku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }

    public function generateKode($kategoriId)
    {
        // Ambil data kategori berdasarkan ID
        $kategori = \App\Models\Kategori::find($kategoriId);

        if (!$kategori) {
            return response()->json([
                'error' => 'Kategori tidak ditemukan'
            ], 404);
        }

        // Ambil nama kategori & huruf pertama
        $namaKategori = $kategori->kategori;
        $inisial = strtoupper(mb_substr($namaKategori, 0, 1));

        // Hitung jumlah buku berdasarkan nama kategori
        $count = \App\Models\DataBuku::where('kategori', $namaKategori)->count() + 1;

        // Format nomor urut
        $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);

        // Bentuk kode buku
        $kodeBuku = 'BK' . $inisial . $nomor;

        return response()->json([
            'kode' => $kodeBuku
        ]);
    }


    public function edit($id)
    {
        $buku = DataBuku::findOrFail($id);
        return view('admin.edit_buku', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = \App\Models\DataBuku::findOrFail($id);

        $request->validate([
            'judul_buku'   => 'required',
            'penerbit'     => 'required',
            'pengarang'    => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . date('Y'),
            'cover_buku'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'     => 'required|exists:kategori,id',
        ]);

        // Ambil kategori baru
        $kategoriModel = \App\Models\Kategori::find($request->kategori);
        $kategoriName = $kategoriModel->kategori;

        // Jika kategori berubah, generate ulang kode buku
        if ($kategoriName !== $buku->kategori) {
            $inisial = strtoupper(mb_substr($kategoriName, 0, 1));
            $count = \App\Models\DataBuku::where('kategori', $kategoriName)->count() + 1;
            $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);
            $buku->kode_buku = 'BK' . $inisial . $nomor;
        }

        $buku->judul_buku   = $request->judul_buku;
        $buku->penerbit     = $request->penerbit;
        $buku->pengarang    = $request->pengarang;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategori     = $kategoriName;

        if ($request->hasFile('cover_buku')) {
            if ($buku->cover_buku) {
                Storage::disk('public')->delete($buku->cover_buku);
            }
            $path = $request->file('cover_buku')->store('covers', 'public');
            $buku->cover_buku = $path;
        }

        $buku->save();

        return redirect()->route('admin.management_buku')->with('success', 'Buku berhasil diperbarui!');
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.tambah_buku', compact('kategori'));
    }




    //kasir
    public function data_buku()
    {
        return view('kasir.data_buku');
    }
}
