<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDisposalController extends Controller
{
    public function index()
    {
        return view('admin.datadisposal.index');
    }
}
