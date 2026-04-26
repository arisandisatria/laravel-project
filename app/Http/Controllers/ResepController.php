<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    public function index(Request $request)
    {

        $query = Resep::with(['rekamMedis.pasien.user', 'rekamMedis.dokter.user'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_resep', 'like', "%{$search}%")
                  ->orWhereHas('rekamMedis.pasien.user', function ($qPasien) use ($search) {
                      $qPasien->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('urgensi') && $request->urgensi !== 'Semua Urgensi') {
            $query->where('urgensi', $request->urgensi);
        }

        $tab = $request->get('tab', 'aktif');

        if ($tab === 'selesai') {
            $query->where('status', 'Selesai');
        } else {
            $query->whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan']);
        }

        $reseps = $query->paginate(10)->withQueryString();
        $totalAntrean = Resep::whereIn('status', ['Menunggu', 'Diproses', 'Disiapkan'])->count();

        return view('apoteker.resep.index', compact('reseps', 'totalAntrean', 'tab'));
    }

    public function proses($id)
    {
        $resep = Resep::with(['rekamMedis.pasien.user', 'rekamMedis.dokter.user', 'obat'])->findOrFail($id);

        return view('apoteker.resep.proses', compact('resep'));
    }

    public function updateStatus(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $request->validate([
            'status'  => 'required|in:Menunggu,Diproses,Disiapkan,Selesai',
        ]);


        $obatDiresepkan = $resep->obat;


        if ($request->status === 'Selesai' && $resep->status !== 'Selesai') {
            if (!$obatDiresepkan || $obatDiresepkan->stok < $resep->jumlah) {
                return back()->with('error', 'Gagal memproses! Stok obat tidak mencukupi untuk resep ini.');
            }
            $obatDiresepkan->decrement('stok', $resep->jumlah);
        }

        $resep->update([
            'status' => $request->status,
            'apoteker_id' => Auth::id(),
        ]);

        return redirect()->route('permintaan-resep.index')->with('success', 'Status resep berhasil diperbarui!');
    }
}
