<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalObat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_obats';

    protected $fillable = [
        'pasien_id',
        'obat_id',
        'waktu_minum',
        'tanggal_selesai',
        'aturan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
