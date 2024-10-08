<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusPengembalianController extends Controller
{
    public function index()
    {
        return view('admin.statuspengembalian.index');
    }
}
