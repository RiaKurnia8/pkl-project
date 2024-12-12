<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilAdminController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        $user = Auth::user();
        return view('admin.profiladmin.index', compact('plants',  'user'));
    }



    public function edit()
    {
        $plants = Plant::all();

        $user = Auth::user();
        // Menampilkan form edit profil admin
        return view('admin.profiladmin.edit', compact('plants', 'user'));
    }

    public function update(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'plant_id' => 'required|exists:plants,id',
            //'plant' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update profil pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->nomor_hp = $request->nomor_hp;
        $user->plant_id = $request->plant_id;
        //$user->plant = $request->plant;
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
        return view('admin.profiladmin.updateps');
    }

    // Handle the password update request
    public function postUpdatePassword(Request $request)
{
    // Validate the request with custom messages
    $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'password.confirmed' => 'Password yang Anda masukkan tidak cocok.',
    ]);

    // Cek apakah password lama sesuai dengan password yang terdaftar
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        // Mengirimkan error password lama salah
        return back()->withErrors([
            'current_password' => 'Password yang Anda masukkan salah.',
            
        ]);
    }

    // Cek apakah password baru dan konfirmasi password cocok
    if ($request->password !== $request->password_confirmation) {
        // Mengirimkan error password baru dan konfirmasi tidak cocok
        return back()->withErrors([
            'password' => 'Password baru dan konfirmasi password tidak cocok.'
        ]);
    }

    // Update the password
    Auth::user()->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->back()->with('status', 'profile-updated');
}

}
