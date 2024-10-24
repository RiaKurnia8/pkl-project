<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi',
        'barang',
        'no_asset',
        'no_equipment',
        'kategori_id', // pastikan kolom ini ada dalam fillable
        'merk',
        'tipe',
        'sn',
        'kelayakan',
        'foto',
        'status',
    ];

    // Definisikan relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}