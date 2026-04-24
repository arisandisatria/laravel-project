<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Obat;
use Carbon\Carbon;

class ApotekerController extends Controller
{
    public function index()
    {
        // 1. Statistik Resep
        // Menghitung resep yang masih aktif (belum selesai)
        $resepBaru = Resep::whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])->count();

        // Menghitung resep yang selesai KHUSUS hari ini (agar angka dashboard lebih realistis)
        $resepSelesai = Resep::where('status', 'Selesai')
                             ->whereDate('updated_at', Carbon::today())
                             ->count();

        // 2. Statistik Inventaris Obat (Batas kritis stok < 10 sesuai aturanmu sebelumnya)
        $stokKritisCount = Obat::where('stok', '<', 10)->count();
        $totalObat = Obat::count();

        // 3. Data Antrean Resep (Ambil 5 resep terbaru yang belum selesai beserta nama pasien & dokter)
        $antreanResep = Resep::with(['rekamMedis.pasien.user', 'rekamMedis.dokter.user'])
                             ->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])
                             ->orderBy('created_at', 'asc')
                             ->take(5)
                             ->get();

        // 4. Data Peringatan Stok (Ambil 5 obat dengan stok paling sedikit)
        $peringatanStok = Obat::where('stok', '<', 10)
                              ->orderBy('stok', 'asc')
                              ->take(5)
                              ->get();

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
