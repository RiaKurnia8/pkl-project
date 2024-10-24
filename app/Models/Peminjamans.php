<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjamans extends Model
{
    use HasFactory;

    protected $table = 'peminjamans'; // Pastikan ini sesuai dengan nama tabel

    protected $fillable = [
        'nik',
        'username',
        'plant',
        'barang_dipinjam',
        'tanggal_pinjam',
        'status',
    ];
}
