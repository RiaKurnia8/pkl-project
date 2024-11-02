<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        // Mengambil data user tanpa kolom password untuk tampilan index
       // $users = User::select('id', 'name', 'nik','usertype', 'username', 'nomor_hp', 'plant', 'jenis_kelamin')->paginate(10);
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
        'name' => 'required',
        'nik' => 'required|digits_between:1,5',
        'username' => 'required|unique:users,username',
        'nomor_hp' => 'required',
        'plant' => 'required',
        'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
        'password' => 'nullable|min:8', // Password tidak wajib diisi
    ], [
        'name.required' => 'Nama wajib diisi!!',
        'nik.required' => 'NIK wajib diisi!!',
        'username.required' => 'Username wajib diisi!!',
        'nomor_hp.required' => 'No.Hp wajib diisi!!',
        'plant.required' => 'Plant wajib diisi!!',
        'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!!',
        'password.min' => 'Password harus minimal 8 karakter!!',
        // Hapus validasi konfirmasi password
    ]);
    
    // Simpan data dengan hashing password
    $data = $request->except('_token', 'password_confirmation');
    
    // Hanya hash password jika diisi
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }
    
    User::create($data);

    return redirect()->route('admin.useradmin.index')->with('success', 'User Berhasil dibuat');
}
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.useradmin.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    // Validasi data
    $validated = $request->validate([
        'name' => 'required',
        'nik' => 'required|digits_between:1,5',
        'username' => 'required|unique:users,username,' . $id,
        'nomor_hp' => 'required',
        'plant' => 'required',
        'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
        'password' => 'nullable|min:8', // Password tidak wajib diisi
    ], [
        'name.required' => 'Nama wajib diisi!!',
        'nik.required' => 'NIK wajib diisi!!',
        'username.required' => 'Username wajib diisi!!',
        'nomor_hp.required' => 'No.Hp wajib diisi!!',
        'plant.required' => 'Plant wajib diisi!!',
        'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!!',
        'password.min' => 'Password harus minimal 8 karakter!!',
        // Hapus validasi konfirmasi password
    ]);

    // Temukan user berdasarkan ID
    $user = User::findOrFail($id);

    // Update data, hanya hash password jika diisi
    $data = $request->except('_token', 'password', 'password_confirmation');
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);
    return redirect()->route('admin.useradmin.index')->with('success', 'User Berhasil diedit');
}

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.useradmin.index')->with('error', 'Data user tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('admin.useradmin.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('cari');
        $users = User::where('name', 'like', "%" . $keyword . "%")
            ->orWhere('nik', 'like', "%" . $keyword . "%")
            ->orWhere('usertype', 'like', "%" . $keyword . "%")
            ->orWhere('username', 'like', "%" . $keyword . "%")
            ->orWhere('nomor_hp', 'like', "%" . $keyword . "%")
            ->orWhere('plant', 'like', "%" . $keyword . "%")
            ->orWhere('jenis_kelamin', 'like', "%" . $keyword . "%")
            ->paginate(10);

        return view('admin.useradmin.index', compact('users'));
    }
}
