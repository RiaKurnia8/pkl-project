<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataDisposalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HpeminjamanController;
use App\Http\Controllers\HpengembalianController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\StatusPeminjamanController;
use App\Http\Controllers\StatusPengembalianController;
use App\Http\Controllers\UpeminjamanController;
use App\Http\Controllers\UpengembalianController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user
Route::get('/user/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('user.dashboard');

Route::get('/user/hpeminjaman',[HpeminjamanController::class, 'index'])->name('user.hpeminjaman.index');
Route::get('/user/hpeminjaman',[HpeminjamanController::class, 'search'])->name('user.hpeminjaman.search');


Route::get('/user/hpengembalian',[HpengembalianController::class, 'index'])->name('user.hpengembalian.index');
Route::get('/user/hpengembalian',[HpengembalianController::class, 'search'])->name('user.hpengembalian.search');

Route::get('/user/upeminjaman',[UpeminjamanController::class, 'index'])->name('user.upeminjaman.index');
Route::get('/user/upengembalian',[UpengembalianController::class, 'index'])->name('user.upeminjaman.index');

Route::get('/user/upeminjaman', [UpeminjamanController::class, 'index'])->name('peminjaman.index'); // Menampilkan form
Route::post('/user/upeminjaman', [UpeminjamanController::class, 'store'])->name('peminjaman.store'); 

Route::get('/user/hpeminjaman/cari', [HpeminjamanController::class, 'search'])->name('user.hpeminjaman.search');
//profil user
Route::get('/user/profiluser', [ProfilUserController::class, 'index'])->name('user.profiluser.index');
Route::get('/user/profile', [ProfilUserController::class, 'edit'])->name('user.profile.edit');
Route::patch('/user/profile', [ProfilUserController::class, 'update'])->name('user.profile.update');
Route::get('/user/edit-password', [ProfilUserController::class, 'updatePassword'])->name('user.profile.updatePassword');

// Route to handle the form submission for updating the password
Route::post('/user/edit-password', [ProfilUserController::class, 'postUpdatePassword'])->name('user.profile.postUpdatePassword');

Route::get('/user/hpengembalian/cari', [HpengembalianController::class, 'search'])->name('user.hpengembalian.search');

//admin
Route::get('admin/dashboard', [HomeController::class,'index'])
->middleware(['auth', 'admin'])
->name('admin.dashboard.index');

Route::get('admin/riwayat-sampah', [HomeController::class, 'showTrash'])->middleware(['auth', 'admin'])->name('admin.riwayat_sampah');
Route::post('admin/peminjaman/{id}/delete', [HomeController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.peminjaman.delete');
Route::post('/admin/riwayat-sampah/restore/{id}', [HomeController::class, 'restore'])->name('admin.riwayat_sampah.restore');
Route::post('/admin/riwayat-sampah/delete/{id}', [HomeController::class, 'forceDelete'])->name('admin.riwayat_sampah.delete');
Route::get('admin/export-peminjaman', [HomeController::class, 'exportPeminjaman'])->name('admin.export.peminjaman');
Route::get('/admin/dashboard/exportpdf', [HomeController::class, 'exportPdf'])->name('admin.dashboard.exportPdf');

//dashboard admin
Route::get('/admin/dashboard/search', [HomeController::class, 'search'])->name('admin.dashboard.search');

//data barang
Route::get('/admin/databarang', [DataBarangController::class, 'index'])->name('admin.databarang.index');
Route::get('/admin/databarang/cari', [DataBarangController::class, 'search'])->name('admin.databarang.search');
Route::get('admin/databarang/export/', [DataBarangController::class, 'export'])->name('admin.databarang.xls');

Route::get('/admin/databarang/add', [DataBarangController::class, 'create'])->name('admin.databarang.create');
Route::post('/admin/databarang/add', [DataBarangController::class, 'store'])->name('admin.databarang.store');
Route::get('/admin/databarang/exportpdf', [DataBarangController::class, 'exportPdf'])->name('admin.databarang.exportPdf');

Route::get('/admin/databarang/{id}', [DataBarangController::class, 'edit'])->name('admin.databarang.edit');
Route::post('/admin/databarang/{id}', [DataBarangController::class, 'update'])->name('admin.databarang.update');
Route::delete('/admin/databarang/{id}', [DataBarangController::class, 'destroy'])->name('admin.databarang.destroy');

Route::get('/admin/useradmin', [UserAdminController::class, 'index'])->name('admin.useradmin.index');






Route::get('/admin/datadisposal', [DataDisposalController::class, 'index'])->name('admin.datadisposal.index');
Route::get('/admin/datadisposal/cari', [DataDisposalController::class, 'search'])->name('admin.datadisposal.search');
Route::get('admin/datadisposal/export/', [DataDisposalController::class, 'export'])->name('admin.datadisposal.xls');
Route::get('/admin/datadisposal/exportpdf', [DataDisposalController::class, 'exportPdf'])->name('admin.datadisposal.exportPdf');

//kategori
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('admin.pengembalian.index');
Route::get('/admin/statuspeminjaman', [StatusPeminjamanController::class, 'index'])->name('admin.statuspeminjaman.index');
Route::get('/admin/statuspengembalian', [StatusPengembalianController::class, 'index'])->name('admin.statuspengembalian.index');


//update profil admin
Route::get('/admin/profiladmin', [ProfilAdminController::class, 'index'])->name('admin.profiladmin.index');
Route::get('/admin/profile', [ProfilAdminController::class, 'edit'])->name('profile.edit');
Route::patch('/admin/profile', [ProfilAdminController::class, 'update'])->name('profile.update');
//update password
//Route::get('/admin/ubah-password', [ProfilAdminController::class, 'updatePassword'])->name('profile.updatePassword');
// Route to display the update password form
Route::get('/admin/ubah-password', [ProfilAdminController::class, 'updatePassword'])->name('profile.updatePassword');

// Route to handle the form submission for updating the password
Route::post('/admin/ubah-password', [ProfilAdminController::class, 'postUpdatePassword'])->name('profile.postUpdatePassword');
// Route untuk memperbarui profil admin
//Route::patch('/admin/profiladmin', [ProfilAdminController::class, 'update'])->name('admin.profiladmin.update');

// Route::get('/admin/databarang', [DataBarangController::class, 'search'])->name('admin.databarang.search');
// Route::get('admin/databarang/export/', [DataBarangController::class, 'export'])->name('admin.databarang.xls');

//useradmin
Route::get('/admin/useradmin', [UserAdminController::class, 'index'])->name('admin.useradmin.index');
Route::get('/admin/useradmin/cari', [UserAdminController::class, 'search'])->name('admin.useradmin.search');
Route::get('/admin/useradmin/create', [UserAdminController::class, 'create'])->name('admin.useradmin.create');
Route::post('/admin/useradmin/store', [UserAdminController::class, 'store'])->name('admin.useradmin.store');
Route::get('/admin/useradmin/{id}', [UserAdminController::class, 'edit'])->name('admin.useradmin.edit');
Route::put('/admin/useradmin/{id}', [UserAdminController::class, 'update'])->name('admin.useradmin.update');
Route::delete('/admin/useradmin/{id}', [UserAdminController::class, 'destroy'])->name('admin.useradmin.destroy');

//gabungan peminjaman admin user
Route::get('/admin/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('admin.peminjaman.edit');
Route::put('/admin/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('admin.peminjaman.update');
Route::delete('/admin/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');
//trash

//Route::get('admin/peminjaman/trash', [PeminjamanController::class, 'showTrash'])->name('admin.trash');
//Route::post('admin/peminjaman/{id}/restore', [PeminjamanController::class, 'restore'])->name('admin.peminjaman.restore');


Route::put('/admin/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('admin.peminjaman.update');



//Route::get('/admin/hpeminjaman', [PeminjamanController::class, 'index'])->name('user.hpeminjaman');

Route::get('/admin/peminjaman/cari', [PeminjamanController::class, 'search'])->name('admin.peminjaman.search');
Route::get('admin/peminjaman/export/', [PeminjamanController::class, 'export'])->name('admin.peminjaman.xls');
Route::get('/admin/peminjaman/exportpdf', [PeminjamanController::class, 'exportPdf'])->name('admin.peminjaman.exportPdf');



//gabungan pengembalian admin user
Route::get('/admin/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('admin.pengembalian.edit');
Route::put('/admin/pengembalian/{id}', [PengembalianController::class, 'update'])->name('admin.pengembalian.update');
Route::delete('/admin/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('admin.pengembalian.destroy');
Route::put('/admin/pengembalian/{id}', [PengembalianController::class, 'update'])->name('admin.pengembalian.update');

Route::get('/user/upengembalian', [UpengembalianController::class, 'index'])->name('pengembalian.index'); // Menampilkan form
Route::post('/user/upengembalian', [UpengembalianController::class, 'store'])->name('pengembalian.store'); 
Route::get('/admin/hpengembalian', [PengembalianController::class, 'index'])->name('user.pengembalian');

Route::get('/admin/pengembalian/cari', [PengembalianController::class, 'search'])->name('admin.pengembalian.search');
Route::get('admin/pengembalian/export/', [PengembalianController::class, 'export'])->name('admin.pengembalian.xls');
Route::get('/admin/pengembalian/exportpdf', [PengembalianController::class, 'exportPdf'])->name('admin.pengembalian.exportPdf');

