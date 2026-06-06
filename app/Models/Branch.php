<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'target_daily',
        'target_weekly',
        'target_monthly',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
