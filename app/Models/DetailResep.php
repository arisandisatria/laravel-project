<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    protected $fillable = ['resep_id', 'obat_id', 'jumlah', 'aturan_pakai'];

    public function obat() {
        return $this->belongsTo(Obat::class);
    }
}
