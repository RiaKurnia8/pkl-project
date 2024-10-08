<?php

// Pengembaian User

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpengembalianController extends Controller
{
    public function index()
    {
        return view('user.upengembalian.index');
    }
}
