<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kategori extends Controller
{
    //
    public function index()
    {
        return view('admin.management_kategori');
    }
}
