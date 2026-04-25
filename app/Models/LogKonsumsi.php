<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogKonsumsi extends Model
{
    protected $table = 'log_konsumsi';
    protected $fillable = ['resep_id', 'pasien_id', 'waktu', 'tanggal'];

    public function resep() { return $this->belongsTo(Resep::class); }
}
