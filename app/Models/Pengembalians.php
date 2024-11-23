<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalians extends Model
{
    use HasFactory;

    protected $table = 'pengembalians'; // Pastikan ini sesuai dengan nama tabel

    protected $fillable = [
        'nik',
        // 'username',
        'name',
        'plant',
        'barang_dipinjam',
        'tanggal_pengembalian',
        'status',
        'keperluan',
        'notes',
    ];
}
