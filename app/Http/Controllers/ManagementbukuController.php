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
        // Validasi input (hapus kode_buku dari rules, karena akan di-generate)
        $request->validate([
            'judul_buku'   => 'required',
            'penerbit'     => 'required',
            'pengarang'    => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . date('Y'),
            'cover_buku'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'     => 'required',
        ]);

        // === Generate kode buku otomatis ===
        $kategori = $request->kategori;

        // Ambil huruf pertama kategori (uppercase)
        $inisial = strtoupper(substr($kategori, 0, 1));

        // Hitung jumlah buku pada kategori tsb
        $count = DataBuku::where('kategori', $kategori)->count() + 1;

        // Format nomor urut 2 digit (01, 02, ...)
        $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);

        // Bentuk kode buku
        $kodeBuku = 'BK' . $inisial . $nomor;

        // === Handle file upload jika ada ===
        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $coverPath = $request->file('cover_buku')->store('covers', 'public');
        }

        // Simpan data buku
        DataBuku::create([
            'kode_buku'   => $kodeBuku, // <-- otomatis, tidak bisa diubah dari form
            'judul_buku'  => $request->judul_buku,
            'penerbit'    => $request->penerbit,
            'pengarang'   => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'cover_buku'  => $coverPath,
            'kategori'    => $kategori,
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

    public function generateKode($kategori)
    {
        // Ambil huruf pertama kategori
        $inisial = strtoupper(substr($kategori, 0, 1));
        // Hitung jumlah buku di kategori ini
        $count = DataBuku::where('kategori', $kategori)->count() + 1;
        // Format nomor urut 2 digit
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
        // Ambil buku yang akan di-update
        $buku = DataBuku::findOrFail($id);

        // Validasi input (hapus kode_buku dari rules)
        $request->validate([
            'judul_buku'   => 'required',
            'penerbit'     => 'required',
            'pengarang'    => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . date('Y'),
            'cover_buku'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori'     => 'required',
        ]);

        // Jika kategori berubah → generate kode_buku baru
        if ($request->kategori !== $buku->kategori) {
            $kategori = $request->kategori;

            // Ambil huruf pertama kategori (uppercase)
            $inisial = strtoupper(substr($kategori, 0, 1));

            // Hitung jumlah buku pada kategori tsb
            $count = DataBuku::where('kategori', $kategori)->count() + 1;

            // Format nomor urut 2 digit
            $nomor = str_pad($count, 2, '0', STR_PAD_LEFT);

            // Bentuk kode buku baru
            $buku->kode_buku = 'BK' . $inisial . $nomor;
        }

        // Update atribut dasar
        $buku->judul_buku   = $request->judul_buku;
        $buku->penerbit     = $request->penerbit;
        $buku->pengarang    = $request->pengarang;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->kategori     = $request->kategori;

        // Jika ada upload cover baru
        if ($request->hasFile('cover_buku')) {
            // Hapus file lama bila ada
            if ($buku->cover_buku) {
                Storage::disk('public')->delete($buku->cover_buku);
            }

            // Simpan file baru
            $path = $request->file('cover_buku')->store('covers', 'public');
            $buku->cover_buku = $path;
        }

        // Simpan perubahan
        $buku->save();

        return redirect()
            ->route('admin.management_buku')
            ->with('success', 'Buku berhasil diperbarui!');
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
