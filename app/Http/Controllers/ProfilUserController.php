<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilUserController extends Controller
{
    public function index()
    {
        return view('user.profiluser.index');
    }

    public function edit()
    {
        // Menampilkan form edit profil user
        return view('user.profiluser.edit');
    }

    public function update(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'plant' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update profil pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nomor_hp = $request->nomor_hp;
        $user->plant = $request->plant;
        $user->jenis_kelamin = $request->jenis_kelamin;

        // Simpan perubahan
        $user->save();

        return back()->with('status', 'profile-updated');
    }


    
    //update password
     // Show the form to update the password
     // Show the form to update the password
    public function updatePassword()
    {
        return view('user.profiluser.updateps');
    }

    // Handle the password update request
    public function postUpdatePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'profile-updated');
    }
}
