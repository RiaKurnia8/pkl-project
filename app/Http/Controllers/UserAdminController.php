<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        return view('admin.useradmin.index');
    }
}
