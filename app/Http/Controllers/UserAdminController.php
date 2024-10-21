<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.useradmin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.useradmin.form');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required',  // Validasi untuk kolom name
            'nik' => 'required',
            'username' => 'required',
            'nomor_hp' => 'required',
            'plant' => 'required',
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'password' => 'required|min:8', // Tambahkan validasi minimal untuk password
        ], [
            'name.required' => 'Nama wajib diisi!!',  // Pesan untuk kolom name
            'nik.required' => 'NIK wajib diisi!!',
            'username.required' => 'Username wajib diisi!!',
            'nomor_hp.required' => 'No.Hp wajib diisi!!',
            'plant.required' => 'Plant wajib diisi!!',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!!',
            'password.required' => 'Password wajib diisi!!',
            'password.min' => 'Password harus minimal 8 karakter!!', // Pesan untuk validasi minimal
        ]);
        
        // Simpan data (password di-hash sebelum disimpan)
        $data = $request->except('_token');
        $data['password'] = Hash::make($request->password); // Hash password
        User::create($data);

        return redirect()->route('admin.useradmin.index')->with('success', 'User Berhasil dibuat');
    }

    // Edit & Update
    public function edit($id)
    {
        // $users = User::find($id);
        // return view('admin.useradmin.edit', compact('users'));
        $user = User::find($id); // Ganti $users menjadi $user
        return view('admin.useradmin.edit', compact('user')); // Gunakan 'user'
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required',  // Validasi untuk kolom name'
            'nik' => 'required',
            'username' => 'required',
            'nomor_hp' => 'required',
            'plant' => 'required',
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'password' => 'sometimes|min:8', // Password tidak wajib diisi saat update
        ], [
            'name.required' => 'Nama wajib diisi!!',  // Pesan untuk kolom name
            'nik.required' => 'NIK wajib diisi!!',
            'username.required' => 'Username wajib diisi!!',
            'nomor_hp.required' => 'No.Hp wajib diisi!!',
            'plant.required' => 'Plant wajib diisi!!',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!!',
            'password.min' => 'Password harus minimal 8 karakter!!', // Pesan untuk validasi minimal
        ]);

        // Ambil user dari ID
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.useradmin.index')->with('error', 'User tidak ditemukan');
        }

        // Update data
        $data = $request->except('_token', 'password');

        // Jika password diisi, maka update, jika tidak biarkan tetap seperti yang lama
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash password sebelum update
        }

        $user->update($data);
        return redirect()->route('admin.useradmin.index')->with('success', 'User Berhasil diedit');

    }

    // Hapus data
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.useradmin.index')->with('success', 'User Berhasil dihapus');
        }

        return redirect()->route('admin.useradmin.index')->with('error', 'User Gagal dihapus');
    }

    // Pencarian user
    public function search(Request $request)
    {
        $keyword = $request->input('cari');
        $users = User::where('name', 'like', "%" . $keyword . "%")
            ->orWhere('nik', 'like', "%" . $keyword . "%")
            ->orWhere('username', 'like', "%" . $keyword . "%")
            ->orWhere('nomor_hp', 'like', "%" . $keyword . "%")
            ->orWhere('plant', 'like', "%" . $keyword . "%")
            ->orWhere('jenis_kelamin', 'like', "%" . $keyword . "%")
            ->paginate(10);

        return view('admin.useradmin.index', compact('users'));
    }
}
