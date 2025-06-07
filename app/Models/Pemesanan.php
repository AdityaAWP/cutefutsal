<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemesanan extends Model
{
    protected $guarded =[];

    public function lapangans(): BelongsTo
{
    return $this->belongsTo(Lapangan::class, 'lapangan_id');
}

}
