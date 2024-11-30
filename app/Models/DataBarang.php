<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'databarangs'; 
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

    // Relasi ke model Kategori (setiap Databarang punya satu Kategori)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Event untuk mengontrol perubahan updated_at hanya ketika kelayakan berubah
    public static function boot()
    {
        parent::boot();

        static::updating(function ($databarang) {
            // Mengecek apakah hanya kelayakan yang diubah
            if ($databarang->isDirty('kelayakan')) {
                // Biarkan updated_at berubah karena kelayakan berubah
                $databarang->timestamps = true;
            } else {
                // Hentikan perubahan updated_at jika selain kelayakan yang diubah
                $databarang->timestamps = false;
            }
        });
    }

}
