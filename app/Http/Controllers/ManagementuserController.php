<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementuserController extends Controller
{
    public function index()
    {
        return view('admin.management_kasir');
    }
}
