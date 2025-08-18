<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementbukuController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar buku
        return view('admin.management_buku');
    }
}
