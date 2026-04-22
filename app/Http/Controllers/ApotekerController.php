<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        // TODO: Nanti ini akan diganti dengan query asli dari database (Model Obat & Resep)
        // Contoh query asli nanti: $resepBaru = Resep::where('status', 'baru')->count();

        // Data statis sementara untuk menghidupkan UI dasbor
        $resepBaru = 5;
        $resepSelesai = 3;
        $stokKritisCount = 4;
        $totalObat = 124;

        // Data dummy untuk tabel antrean
        $antreanResep = [
            (object)['id_resep' => '#RSP-101', 'nama_pasien' => 'Andi Wijaya', 'nama_dokter' => 'dr. Andi Hermawan'],
            (object)['id_resep' => '#RSP-102', 'nama_pasien' => 'Budi Santoso', 'nama_dokter' => 'dr. Andi Hermawan'],
        ];

        // Data dummy untuk peringatan stok
        $peringatanStok = [
            (object)['nama_obat' => 'Paracetamol 500mg', 'sisa' => 2, 'satuan' => 'kotak']
        ];

        return view('apoteker.index', compact(
            'resepBaru',
            'resepSelesai',
            'stokKritisCount',
            'totalObat',
            'antreanResep',
            'peringatanStok'
        ));
    }
}
