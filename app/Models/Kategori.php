<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel, jika tidak sama dengan plural dari nama model
    protected $table = 'kategoris';

    // Kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama_kategori',
        'status', // Tambahkan status di sini
    ];

    // Relasi ke model Databarang (satu Kategori memiliki banyak Databarang)
    public function databarang()
    {
        return $this->hasMany(Databarang::class);
    }
}
