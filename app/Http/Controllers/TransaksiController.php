<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //admin
    public function riwayat()
    {
        // Logika untuk menampilkan daftar transaksi
        return view('admin.riwayat_transaksi');
    }


    //kasir
    public function riwayat_transaksi()
    {
        // Logika untuk menampilkan daftar transaksi
        return view('kasir.riwayat_transaksi');
    }

    public function transaksi()
    {
        return view('kasir.transaksi');
    }
}
