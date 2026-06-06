<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatDetergen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detergen()
    {
        return $this->belongsTo(Detergen::class);
    }
}
