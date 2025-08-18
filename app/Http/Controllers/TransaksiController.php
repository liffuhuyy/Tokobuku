<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar transaksi
        return view('admin.riwayat_transaksi');
    }
}
