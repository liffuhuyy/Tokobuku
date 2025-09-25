<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;
use App\Models\DataBuku;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Hanya role admin yang bisa akses controller ini
        $this->middleware('role:admin');
    }

    public function index()
    {
        $totalBuku = \App\Models\DataBuku::count();
        $totaluser = User::count();
        $buku = DataBuku::all();


        return view('admin.dashboard', compact('totalBuku', 'totaluser', 'buku'));
    }
}
