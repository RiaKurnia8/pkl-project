<?php

// Pengembalian User

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HpengembalianController extends Controller
{
    public function index()
    {
        return view('user.hpengembalian.index');
    }
}
