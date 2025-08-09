<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;

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
        return view('admin.dashboard');
    }
}
