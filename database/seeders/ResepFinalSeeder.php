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
            'keluhan_utama' => "Sakit aja pokoknya",
            'diagnosa' => "Gk tahu"
        ]);

        $rekamMedis2 = RekamMedis::create([
            'pasien_id' => $pasien->id,
            'dokter_id' => $dokter->id,
            'keluhan_utama' => "Sakit aja pokoknya",
            'diagnosa' => "Gk tahu"
        ]);

        // 6. Buat Resep (Instruksi dari Dokter)

        // Resep A: Masih Menunggu (Apoteker belum menyentuh)
        Resep::create([
            'rekam_medis_id' => $rekamMedis1->id,
            'obat_id' => $obat1->id, // Dokter meresepkan Amoxicillin
            'kode_resep' => 'RSP-2001',
            'urgensi' => 'Segera (Cito)',
            'status' => 'Menunggu',
            'created_at' => Carbon::now()->subMinutes(15),
        ]);

        // Resep B: Sudah Selesai (Diserahkan oleh Apoteker sebelumnya)
        Resep::create([
            'rekam_medis_id' => $rekamMedis2->id,
            'obat_id' => $obat2->id, // Dokter meresepkan Paracetamol
            'apoteker_id' => $apoteker->id, // Tanda tangan apoteker yang memproses
            'kode_resep' => 'RSP-2002',
            'urgensi' => 'Normal',
            'status' => 'Selesai',
            'created_at' => Carbon::now()->subHours(2),
        ]);
    }
}
