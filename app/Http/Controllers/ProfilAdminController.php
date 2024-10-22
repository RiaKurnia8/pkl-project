<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilAdminController extends Controller
{
    public function index()
    {
        return view('admin.profiladmin.index');
    }
    
}
