<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        // Mengambil data user tanpa kolom password untuk tampilan index
        // $users = User::select('id', 'name', 'nik','usertype', 'username', 'nomor_hp', 'plant', 'jenis_kelamin')->paginate(10);
        //    $users = User::with('plant')->paginate(10);
        $users = User::where('is_deleted', false)->get();

        return view('admin.useradmin.index', compact('users'));
    }

    public function create()
    {
        $plants = Plant::where('status', 'on')->get();
        return view('admin.useradmin.form', compact('plants'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required',
            // 'nik' => 'required|digits_between:1,5',
            'nik' => 'required|digits_between:1,5|unique:users,nik',
            'usertype' => 'required',
            // 'username' => 'required|unique:users,username',
            'nomor_hp' => 'required',
            'plant_id' => 'required',
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'password' => 'nullable|min:8', // Password tidak wajib diisi
        ], [
            'name.required' => 'Nama wajib diisi!!',
            'nik.required' => 'NIK wajib diisi!!',
            'nik.unique' => 'Nomor NIK Sudah Terdaftar',
            'usertype.required' => 'Usertype wajib diisi!!',
            // 'username.required' => 'Username wajib diisi!!',
            'nomor_hp.required' => 'No.Hp wajib diisi!!',
            'plant_id.required' => 'Plant wajib diisi!!',
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
        $plants = Plant::where('status', 'on')->get(); // Ambil plant yang statusnya 'on'
        return view('admin.useradmin.edit', compact('user', 'plants'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required',
            'nik' => 'required|digits_between:1,5',
            'usertype' => 'required',
            // 'username' => 'required|unique:users,username,' . $id,
            'nomor_hp' => 'required',
            'plant_id' => 'required',
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'password' => 'nullable|min:8', // Password tidak wajib diisi
        ], [
            'name.required' => 'Nama wajib diisi!!',
            'nik.required' => 'NIK wajib diisi!!',
            'usertype.required' => 'Usertype wajib diisi!!',
            // 'username.required' => 'Username wajib diisi!!',
            'nomor_hp.required' => 'No.Hp wajib diisi!!',
            'plant_id.required' => 'Plant wajib diisi!!',
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
        // $user->delete();
        $user->is_deleted = true;  // Set is_deleted menjadi true
        $user->save();

        if ($user) {
            return redirect()->route('admin.useradmin.index')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect()->route('admin.useradmin.index')->with('failed', 'Data Gagal dihapus');
        }
    }
    public function showTrash()
    {
        // Ambil data barang yang sudah dihapus (is_deleted = true)
        $user = User::where('is_deleted', true)->get();

        return view('admin.useradmin.trash', compact('user'));
    }

    public function restore($id)
    {
        // Cari data peminjaman berdasarkan ID
        $user = User::findOrFail($id);

        // Ubah status is_deleted menjadi false untuk mengembalikan data
        $user->is_deleted = false;
        $user->save();

        // Redirect kembali ke halaman Riwayat Sampah dengan pesan sukses
        return redirect()->route('admin.useradmin.sampah')->with('success', 'Data berhasil dikembalikan dari Riwayat Sampah.');
    }

    //hapus permanen
    public function forceDelete($id)
    {
        // Cari data peminjaman berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus data secara permanen
        $user->delete();

        // Redirect kembali ke halaman Riwayat Sampah dengan pesan sukses
        return redirect()->route('admin.useradmin.sampah')->with('success', 'Data berhasil dihapus secara permanen.');
    }


    public function resetPassword(Request $request)
{
    // Validasi dan logika reset password
    $user = Auth::user(); // Atau gunakan ID yang dikirimkan
    $user->password = bcrypt($request->password); // Hash password baru
    $user->save();

    return redirect()->back()->with('success', 'Password berhasil direset.');
}

}
