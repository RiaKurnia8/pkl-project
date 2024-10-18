<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'data_barangs';
    protected $fillable = [
        'lokasi',
        'barang',
        'no_asset',
        'no_equipment',
        'kategori',
        'merk',
        'tipe',
        'sn',
        'kelayakan',
        'foto',
        'status',
    ];
    
    protected $casts = [
        'kategori' => 'string',
        'kelayakan' => 'string',
        'status' => 'string',
    ];
    protected $guarded = ['id'];
}
