<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    /** @use HasFactory<\Database\Factories\ResepFactory> */
    use HasFactory;

    protected $table = 'reseps';

    protected $fillable = ['rekam_medis_id', 'apoteker_id', 'obat_id', 'status', 'urgensi', 'kode_resep'];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_medis_id');
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
    public function pasien()
    {
       return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
