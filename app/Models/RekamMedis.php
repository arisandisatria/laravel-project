<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    /** @use HasFactory<\Database\Factories\RekamMedisFactory> */
    use HasFactory;

    protected $fillable = ['pasien_id', 'dokter_id', 'keluhan_utama', 'riwayat_penyakit', 'tensi', 'suhu', 'berat_badan', 'diagnosa'];

    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter() {
        return $this->belongsTo(User::class, 'dokter_id');
    }
    public function resep() {
        return $this->hasOne(Resep::class);
    }
}
