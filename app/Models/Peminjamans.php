<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjamans extends Model
{
    use HasFactory;

    protected $table = 'peminjamans'; // Pastikan ini sesuai dengan nama tabel

    protected $fillable = [
        'id',
        'nik',
        //'username',
        'name',
        'plant',
        'barang_dipinjam',
        'tanggal_pinjam',
        'status',
        'keterangan',
        'tanggal_pengembalian',
        'keperluan',
        'notes',
        'is_deleted'
    ];

    public function pengembalian()
    {
        return $this->hasOne(Pengembalians::class, 'peminjaman_id');
    }
    
}
