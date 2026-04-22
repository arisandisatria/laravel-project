<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    /** @use HasFactory<\Database\Factories\ObatFactory> */
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = ['kode_obat', 'nama_obat', 'kategori', 'satuan', 'stok', 'harga', 'keterangan', 'tanggal_expired'];

    protected function casts(): array
    {
        return [
            'harga' => 'integer',
            'stok' => 'integer',
            'tanggal_expired' => 'date',
        ];
    }
}
