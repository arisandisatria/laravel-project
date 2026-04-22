<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $query = Obat::latest();

        if ($request->filled('search')) {
            $query->where('nama_obat', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_obat', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori') && $request->kategori !== 'Semua Kategori') {
            $query->where('kategori', $request->kategori);
        }

        $obat = $query->paginate(10)->withQueryString();

        $itemKritis = Obat::where('stok', '<', 10)->count();

        return view('apoteker.obat.index', compact('obat', 'itemKritis'));
    }

    public function create()
    {
        return view('apoteker.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required|unique:obats,kode_obat',
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0|max:2000000000',
            'harga' => 'required|numeric|min:0|max:2000000000',
            'keterangan' => 'nullable|string',
            'tanggal_expired' => 'nullable|date'
        ]);

        Obat::create($request->all());

        return redirect()->route('stok-obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = Obat::findOrFail($id);

        return view('apoteker.obat.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_obat' => 'required|unique:obats,kode_obat,' . $id,
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0|max:2000000000',
            'harga' => 'required|numeric|min:0|max:2000000000',
            'keterangan' => 'nullable|string'
        ]);

        $item = Obat::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('stok-obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('stok-obat.index')->with('success', 'Data obat berhasil dihapus!');
    }
}
