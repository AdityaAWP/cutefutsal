<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $guarded = [];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
