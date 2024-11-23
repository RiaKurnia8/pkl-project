<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $table = 'plants';
    protected $fillable = [
        'plant',
        'status', // Tambahkan status di sini
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
