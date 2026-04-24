<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();

        $totalPasien = RekamMedis::where('dokter_id', $dokter->id)
                                 ->distinct('pasien_id')
                                 ->count('pasien_id');

        $resepDiterbitkan = Resep::whereHas('rekamMedis', function($query) use ($dokter) {
                                    $query->where('dokter_id', $dokter->id);
                                 })
                                 ->whereDate('created_at', Carbon::today())
                                 ->count();

        $antreanMenunggu = Resep::whereHas('rekamMedis', function($query) use ($dokter) {
                                    $query->where('dokter_id', $dokter->id);
                                 })
                                 ->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])
                                 ->count();

        $obatKosong = Obat::where('stok', 0)->count();

        $resepTerbaru = Resep::with(['rekamMedis.pasien.user'])
                             ->whereHas('rekamMedis', function($query) use ($dokter) {
                                 $query->where('dokter_id', $dokter->id);
                             })
                             ->latest()
                             ->take(5)
                             ->get();

        $obatKritis = Obat::where('stok', '<', 10)->where('stok', '>', 0)->get();

        return view('dokter.index', compact(
            'totalPasien',
            'resepDiterbitkan',
            'antreanMenunggu',
            'obatKosong',
            'resepTerbaru',
            'obatKritis'
        ));
    }

    public function manajemenPasien(Request $request)
    {
       $query = Pasien::with([
            'user',
            'rekamMedis' => function($q) {
                $q->latest();
            },
            'rekamMedis.dokter.user',
            'rekamMedis.reseps.obat'
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($qUser) use ($search) {
                      $qUser->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $pasiens = $query->paginate(10)->withQueryString();

        return view('dokter.pasien', compact('pasiens'));
    }
   public function editRekamMedis($id)
    {
        $rm = RekamMedis::with(['pasien.user', 'dokter.user', 'reseps.obat'])->findOrFail($id);

        if (Auth::id() !== $rm->dokter->user_id) {
            abort(403, 'Akses Ditolak.');
        }

        $obats = Obat::where('stok', '>', 0)->orderBy('nama_obat', 'asc')->get();

        return view('dokter.rekam-medis.edit', compact('rm', 'obats'));
    }

    public function updateRekamMedis(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);

        // Keamanan
        if (Auth::id() !== $rm->dokter->user_id) {
            return back()->with('error', 'Akses Ditolak: Anda tidak dapat mengedit rekam medis ini.');
        }

        $request->validate([
           'keluhan_utama' => 'required|string',
            'diagnosa'      => 'required|string',
            'riwayat_penyakit' => 'nullable|string',
            'tensi' => 'nullable|string',
            'suhu'  => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
        ]);

        $rm->update([
            'keluhan_utama' => $request->keluhan_utama,
            'diagnosa'      => $request->diagnosa,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'tensi' => $request->tensi,
            'suhu'  => $request->suhu,
            'berat_badan' => $request->berat_badan,
        ]);

        return redirect()->route('dokter.pasien')->with('success', 'Data Rekam Medis berhasil diperbarui!');
    }

    public function destroyRekamMedis($id)
    {
        $rm = RekamMedis::findOrFail($id);

        if (Auth::id() !== $rm->dokter->user_id) {
            return back()->with('error', 'Akses Ditolak: Anda tidak dapat menghapus data ini.');
        }

        $rm->delete();

        return back()->with('success', 'Riwayat rekam medis beserta resep terkait berhasil dihapus secara permanen.');
    }

    public function periksa($id)
    {
        $pasien = Pasien::with('user')->findOrFail($id);

        return view('dokter.rekam-medis.create', compact('pasien'));
    }

    public function simpanPemeriksaan(Request $request, $id)
    {
        $request->validate([
            'keluhan_utama' => 'required|string',
            'diagnosa'      => 'required|string',
            'riwayat_penyakit' => 'nullable|string',
            'tensi' => 'nullable|string',
            'suhu'  => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
        ]);

        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();

        $rm = RekamMedis::create([
            'pasien_id'     => $id,
            'dokter_id'     => $dokter->id,
            'keluhan_utama' => $request->keluhan_utama,
            'diagnosa'      => $request->diagnosa,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'tensi' => $request->tensi,
            'suhu'  => $request->suhu,
            'berat_badan' => $request->berat_badan,
        ]);

        if ($request->has('resepkan_obat')) {
            return redirect()->route('dokter.resep.create', $rm->id)
                             ->with('success', 'Pemeriksaan disimpan. Silakan tulis E-Resep untuk pasien.');
        }

        return redirect()->route('dokter.pasien')
                         ->with('success', 'Pemeriksaan selesai dan berhasil disimpan tanpa resep obat.');
    }

    public function createResep()
    {
        $pasiens = Pasien::with('user')->get();

        $obats = Obat::where('stok', '>', 0)->get();

        return view('dokter.resep.create', compact('pasiens', 'obats'));
    }

    public function storeResep(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasiens,id',
            'diagnosa'  => 'required|string',
            'obat'      => 'required|array',
            'qty'       => 'required|array',
            'aturan'    => 'required|array',
        ]);

        $dokter = Dokter::where('user_id', Auth::id())->firstOrFail();

        $rm = RekamMedis::create([
            'pasien_id'     => $request->id_pasien,
            'dokter_id'     => $dokter->id,
            'keluhan_utama' => 'Pembuatan E-Resep Langsung',
            'diagnosa'      => $request->diagnosa,
        ]);

        foreach ($request->obat as $key => $obat_id) {
            if ($obat_id != null) {
                Resep::create([
                    'rekam_medis_id' => $rm->id,
                    'obat_id'        => $obat_id,
                    'kode_resep'     => 'RSP-' . rand(1000, 9999),
                    'urgensi'        => 'Normal',
                    'status'         => 'Menunggu',
                    'jumlah'         => $request->qty[$key],
                    'aturan'         => $request->aturan[$key],
                ]);
            }
        }

        return redirect('/kelola-resep')->with('success', 'E-Resep berhasil dikirim ke Apotek!');
    }
}
