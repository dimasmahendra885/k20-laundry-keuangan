<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'alamat',
        'nomor_telepon',
        'pesan_struk',
        'target_harian',
        'target_mingguan',
        'target_bulanan',
    ];
}
