<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.manajemen-user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.manajemen-user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,dokter,apoteker,pasien',
        ]);

        DB::transaction(function () use ($request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'dokter') {

            $request->validate(['poli' => 'required|string']);

            Dokter::create([
                'user_id' => $user->id,
                'poli' => $request->poli,
            ]);

        } elseif ($request->role === 'pasien') {

            $request->validate([
                'nik' => 'required|string|size:16|unique:pasiens',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'required|date',
            ]);

            Pasien::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

        }
    });

    return redirect()->route('manajemen-user.index')->with('success', 'User dan Profil berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $editUser = User::findOrFail($id);

        return view('admin.manajemen-user.edit', compact('editUser'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,dokter,apoteker,pasien',
            'password' => 'nullable|string|min:8',
        ]);

        DB::transaction(function () use ($request, $user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            if ($request->role === 'dokter') {
                $request->validate(['poli' => 'required|string']);

                Dokter::updateOrCreate(
                    ['user_id' => $user->id],
                    ['poli' => $request->poli]
                );

            } elseif ($request->role === 'pasien') {
                $request->validate([
                    'nik' => 'required|string|size:16|unique:pasiens,nik,' . ($user->pasien->id ?? ''),
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'tanggal_lahir' => 'required|date',
                ]);

                Pasien::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nik' => $request->nik,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tanggal_lahir' => $request->tanggal_lahir,
                    ]
                );
            }
        });

        return redirect()->route('manajemen-user.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $id) {
            return redirect()->route('manajemen-user.index')->with('error', 'Aksi ditolak! Anda tidak dapat menghapus akun yang sedang Anda gunakan.');
        }

        $user->delete();

        return redirect()->route('manajemen-user.index')->with('success', 'Akun pengguna berhasil dihapus secara permanen.');
    }
}
