<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;
use App\Models\LogKonsumsi;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index()
    {
        // 1. Ambil data pasien yang sedang login
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        // 2. Cari Rekam Medis TERAKHIR yang resepnya sudah ditebus (Selesai/Disiapkan)
        $rmTerakhir = RekamMedis::with(['dokter.user', 'reseps.obat'])
                        ->where('pasien_id', $pasien->id)
                        ->whereHas('reseps', function($q) {
                            $q->whereIn('status', ['Disiapkan', 'Selesai']);
                        })
                        ->latest()
                        ->first();

        // 3. Hitung Statistik Resep (Adaptasi dari Progress Kepatuhan)
        $totalResep = Resep::whereHas('rekamMedis', function($q) use ($pasien) {
            $q->where('pasien_id', $pasien->id);
        })->count();

        $resepSelesai = Resep::whereHas('rekamMedis', function($q) use ($pasien) {
            $q->where('pasien_id', $pasien->id);
        })->where('status', 'Selesai')->count();

        $resepMenunggu = Resep::whereHas('rekamMedis', function($q) use ($pasien) {
            $q->where('pasien_id', $pasien->id);
        })->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])->count();

        return view('pasien.index', compact('pasien', 'rmTerakhir', 'totalResep', 'resepSelesai', 'resepMenunggu'));
    }

    public function jadwalMinum()
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();
        $hariIni = Carbon::today()->toDateString();

        // 1. Ambil Obat Aktif (Asumsi: Resep yang dibuat 7 hari terakhir dan berstatus Selesai dari Apotek)
        $resepAktif = Resep::with(['obat', 'rekamMedis'])
            ->whereHas('rekamMedis', function($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->where('status', 'Selesai')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7)) // Berlaku seminggu
            ->get();

        // 2. Ambil Log Minum Obat HARI INI
        $logHariIni = LogKonsumsi::where('pasien_id', $pasien->id)
            ->where('tanggal', $hariIni)
            ->get();

        // 3. Ambil Log keseluruhan untuk sidebar kanan
        $logRiwayat = LogKonsumsi::with('resep.obat')
            ->where('pasien_id', $pasien->id)
            ->latest()
            ->take(10)
            ->get();

        return view('pasien.jadwal', compact('pasien', 'resepAktif', 'logHariIni', 'logRiwayat'));
    }

    public function tandaiDiminum(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        LogKonsumsi::create([
            'resep_id'  => $request->resep_id,
            'pasien_id' => $pasien->id,
            'waktu'     => $request->waktu,
            'tanggal'   => Carbon::today()->toDateString(),
        ]);

        return back()->with('success', 'Hebat! Anda telah meminum obat untuk jadwal ' . $request->waktu);
    }

    public function riwayatResep()
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        $riwayatRekamMedis = RekamMedis::with(['dokter.user', 'reseps.obat'])
                            ->where('pasien_id', $pasien->id)
                            ->whereHas('reseps')
                            ->latest()
                            ->paginate(10);

        return view('pasien.riwayat', compact('riwayatRekamMedis'));
    }
}
