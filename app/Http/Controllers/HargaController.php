<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\Harga;

class HargaController extends Controller
{
    public function index(Request $request)
    {
        $buku = DataBuku::whereDoesntHave('harga')->get();
        $harga = Harga::with('buku')->get();

        return view('admin.harga', compact('harga', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:databuku,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Pastikan belum ada harga untuk buku ini
        $cek = Harga::where('buku_id', $request->buku_id)->first();
        if ($cek) {
            return back()->with('error', 'Harga untuk buku ini sudah ada!');
        }

        // Simpan ke tabel harga
        Harga::create([
            'buku_id' => $request->buku_id,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return back()->with('success', 'Harga dan stok berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $buku = DataBuku::findOrFail($id);
        $buku->harga = $request->harga;
        $buku->stok = $request->stok;
        $buku->save();

        return redirect()->route('admin.harga', ['id' => $id])->with('success', 'Harga dan stok buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = DataBuku::findOrFail($id);
        $buku->harga = null;
        $buku->stok = null;
        $buku->save();

        return redirect()->back()->with('success', 'Harga dan stok buku berhasil dihapus.');
    }

    public function edit($id)
    {
        $buku = DataBuku::findOrFail($id);
        return view('admin.edit_harga', compact('buku'));
    }
}
