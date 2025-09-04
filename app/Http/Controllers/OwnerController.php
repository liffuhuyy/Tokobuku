<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
    {
        // Hanya role owner yang bisa akses controller ini
        $this->middleware('role:owner');
    }

    public function index()
    {
        return view('owner.dashboard');
    }

    public function buku()
    {
        return view('owner.data_buku');
    }

    public function data_user()
    {
        return view('owner.data_user');
    }

    public function penjualan()
    {
        return view('owner.penjualan');
    }
}
