<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\RekamMedis;
use App\Models\Resep;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResepFinalSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Apoteker (Untuk kamu login)
        $apoteker = User::create([
            'name' => 'Apt. Aris',
            'email' => 'aris@obatku.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'apoteker',
        ]);

        // 2. Buat Dokter
        $userDokter = User::create([
            'name' => 'dr. Andi Hermawan',
            'email' => 'andi.hermawan@obatku.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'dokter',
        ]);
        $dokter = Dokter::create([
            'user_id' => $userDokter->id,
            'poli' => 'Poli Umum',
        ]);

        // 3. Buat Pasien
        $userPasien = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@gmail.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'pasien',
        ]);
        $pasien = Pasien::create([
            'user_id' => $userPasien->id,
            'nik' => '3509123456780005',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1980-05-10', // Umur 45 thn
        ]);

        // 4. Buat Stok Obat di Inventaris
        $obat1 = Obat::create([
            'kode_obat' => 'OBT-21',
            'nama_obat' => 'Amoxicillin 500mg',
            'kategori' => 'Antibiotik',
            'satuan' => 'Tablet',
            'stok' => 50,
            'harga' => 15000,
        ]);

        $obat2 = Obat::create([
            'kode_obat' => 'OBT-42',
            'nama_obat' => 'Paracetamol 500mg',
            'kategori' => 'Analgetik',
            'satuan' => 'Strip',
            'stok' => 100,
            'harga' => 5000,
        ]);

        // 5. Buat Rekam Medis
        $rekamMedis1 = RekamMedis::create([
            'pasien_id' => $pasien->id,
            'dokter_id' => $dokter->id,
            'keluhan_utama' => "Demam tinggi dan batuk berdahak",
            'diagnosa' => "Radang Tenggorokan Akut"
        ]);


        // Resep A: Masih Menunggu (Apoteker belum menyentuh)
        Resep::create([
            'rekam_medis_id' => $rekamMedis1->id, // Tempel ke Rekam Medis 1
            'obat_id' => $obat1->id,
            'kode_resep' => 'RSP-2001',
            'urgensi' => 'Segera (Cito)',
            'status' => 'Menunggu',
            'created_at' => Carbon::now()->subMinutes(15),
        ]);

        // Resep B: Paracetamol
        Resep::create([
            'rekam_medis_id' => $rekamMedis1->id, // TEMPEL JUGA KE REKAM MEDIS 1
            'obat_id' => $obat2->id,
            'apoteker_id' => $apoteker->id,
            'kode_resep' => 'RSP-2002',
            'urgensi' => 'Normal',
            'status' => 'Menunggu',
            'created_at' => Carbon::now()->subMinutes(15),
        ]);
    }
}
