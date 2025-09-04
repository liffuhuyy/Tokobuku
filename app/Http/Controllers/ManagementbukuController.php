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
        // Validasi input
        $request->validate([
            'kode_buku' => 'required|unique:databuku,kode_buku',
            'judul_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y')),
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required',
        ]);

        // Handle file upload jika ada
        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $coverPath = $request->file('cover_buku')->store('covers', 'public');
        }

        // Simpan data buku baru
        DataBuku::create([
            'kode_buku' => $request->kode_buku,
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'cover_buku' => $coverPath,
            'kategori' => $request->kategori,
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

    public function edit($id)
    {
        $buku = DataBuku::findOrFail($id);
        return view('admin.edit_buku', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = DataBuku::findOrFail($id);

        // Validasi input
        $request->validate([
            'kode_buku' => 'required|unique:databuku,kode_buku,' . $buku->id,
            'judul_buku' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1000|max:' . (date('Y')),
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required',
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('cover_buku')) {
            // Hapus file cover lama jika ada
            if ($buku->cover_buku) {
                Storage::disk('public')->delete($buku->cover_buku);
            }
            $buku->cover_buku = $request->file('cover_buku')->store('covers', 'public');
        }

        // Update data buku
        $buku->update([
            'kode_buku' => $request->kode_buku,
            'judul_buku' => $request->judul_buku,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori' => $request->kategori,
        ]);

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
