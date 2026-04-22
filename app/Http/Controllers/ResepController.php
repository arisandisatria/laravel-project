<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisiasi Query dasar dengan memuat relasi (Eager Loading agar cepat)
        $query = Resep::with(['rekamMedis.pasien.user', 'rekamMedis.dokter.user'])->latest();

        // 2. Fitur Pencarian (berdasarkan Kode Resep atau Nama Pasien)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_resep', 'like', "%{$search}%")
                  ->orWhereHas('rekamMedis.pasien.user', function ($qPasien) use ($search) {
                      $qPasien->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 3. (Opsional) Fitur Filter Urgensi jika ada di databasemu
        // if ($request->filled('urgensi') && $request->urgensi !== 'Semua Urgensi') {
        //     $query->where('urgensi', $request->urgensi);
        // }

        // 4. Pisahkan Data Berdasarkan Tab (Menggunakan parameter URL ?tab=selesai)
        $tab = $request->get('tab', 'aktif'); // Default ke tab 'aktif'

        if ($tab === 'selesai') {
            // Ambil resep yang sudah selesai
            $query->where('status', 'Selesai');
        } else {
            // Ambil resep yang sedang antre atau diproses
            $query->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan']);
        }

        // 5. Eksekusi Query dan Hitung Total Antrean Aktif
        $resep = $query->paginate(10)->withQueryString();
        $totalAntrean = Resep::whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])->count();

        return view('apoteker.resep.index', compact('resep', 'totalAntrean', 'tab'));
    }
}
