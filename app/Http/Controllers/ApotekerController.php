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
        $resepBaru = Resep::whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])->count();

        $resepSelesai = Resep::where('status', 'Selesai')
                             ->whereDate('updated_at', Carbon::today())
                             ->count();

        $stokKritisCount = Obat::where('stok', '<', 10)->count();
        $totalObat = Obat::count();

        $antreanResep = Resep::with(['rekamMedis.pasien.user', 'rekamMedis.dokter.user'])
                             ->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])
                             ->orderBy('created_at', 'asc')
                             ->take(5)
                             ->get();

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
