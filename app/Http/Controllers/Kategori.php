<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kategori extends Controller
{
    //
    public function index()
    {
        $kategori = \App\Models\Kategori::all();
        return view('admin.management_kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required',
            'jenis' => 'required',
        ]);

        \App\Models\Kategori::create([
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('admin.management_kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.management_kategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori' => 'required',
            'jenis' => 'required',
        ]);

        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update([
            'kategori' => $request->kategori,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('admin.management_kategori')->with('success', 'Kategori berhasil diperbarui.');
    }
}
