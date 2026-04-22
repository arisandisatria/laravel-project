<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    /** @use HasFactory<\Database\Factories\ResepFactory> */
    use HasFactory;

    protected $table = 'reseps';

    protected $fillable = ['rekam_medis_id', 'apoteker_id', 'status'];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_medis_id');
    }
    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, RekamMedis::class, 'id', 'id', 'rekam_medis_id', 'pasien_id');
    }

    // (Opsional) Shortcut untuk mengambil Dokter
    // public function dokter()
    // {
    //     return $this->hasOneThrough(Dokter::class, RekamMedis::class, 'id', 'id', 'rekam_medis_id', 'dokter_id');
    // }
}
