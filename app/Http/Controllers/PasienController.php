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
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        $rmTerakhir = RekamMedis::with(['dokter.user', 'reseps.obat'])
                        ->where('pasien_id', $pasien->id)
                        ->whereHas('reseps', function($q) {
                            $q->whereIn('status', ['Disiapkan', 'Selesai']);
                        })
                        ->latest()
                        ->first();

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

        $resepAktif = Resep::with(['obat', 'rekamMedis'])
            ->whereHas('rekamMedis', function($q) use ($pasien) {
                $q->where('pasien_id', $pasien->id);
            })
            ->where('status', 'Selesai')
            ->whereDate('created_at', '>=', Carbon::today()->subDays(7))
            ->get();

        $logHariIni = LogKonsumsi::where('pasien_id', $pasien->id)
            ->where('tanggal', $hariIni)
            ->get();

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

    public function riwayatResep(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        $query = RekamMedis::with(['dokter.user', 'reseps.obat'])
                            ->where('pasien_id', $pasien->id)
                            ->whereHas('reseps');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('diagnosa', 'like', "%{$search}%")
                  ->orWhere('keluhan_utama', 'like', "%{$search}%")
                  ->orWhereHas('dokter.user', function($qDokter) use ($search) {
                      $qDokter->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('reseps.obat', function($qObat) use ($search) {
                      $qObat->where('nama_obat', 'like', "%{$search}%");
                  });
            });
        }

        $riwayatRekamMedis = $query->latest()->paginate(10)->withQueryString();

        return view('pasien.riwayat', compact('riwayatRekamMedis'));
    }
}
