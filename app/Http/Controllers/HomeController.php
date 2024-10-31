<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index()
    // {
    //     return view('admin.dashboard');
    // }
    public function index()
    {
        $totalDataBarang = DataBarang::count(); // Menghitung jumlah total data barang
        return view('admin.dashboard', compact('totalDataBarang'));
    }
}
