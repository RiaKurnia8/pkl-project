<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataDisposalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HpeminjamanController;
use App\Http\Controllers\HpengembalianController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
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

Route::get('/user/hpengembalian',[HpengembalianController::class, 'index'])->name('user.hpengembalian.index');

Route::get('/user/upeminjaman',[UpeminjamanController::class, 'index'])->name('user.upeminjaman.index');
Route::get('/user/upengembalian',[UpengembalianController::class, 'index'])->name('user.upeminjaman.index');



//admin
Route::get('admin/dashboard', [HomeController::class,'index'])->
middleware(['auth', 'admin']);

//dashboard admin
Route::get('/admin/databarang', [DataBarangController::class, 'index'])->name('admin.databarang.index');
Route::get('/admin/useradmin', [UserAdminController::class, 'index'])->name('admin.useradmin.index');
Route::get('/admin/datadisposal', [DataDisposalController::class, 'index'])->name('admin.datadisposal.index');
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('admin.pengembalian.index');
Route::get('/admin/statuspeminjaman', [StatusPeminjamanController::class, 'index'])->name('admin.statuspeminjaman.index');
Route::get('/admin/statuspengembalian', [StatusPengembalianController::class, 'index'])->name('admin.statuspengembalian.index');



