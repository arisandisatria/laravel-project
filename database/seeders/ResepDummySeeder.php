<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Resep;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResepDummySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Dokter
        $userDokter = User::create([
            'name' => 'dr. Tirta Mandira',
            'email' => 'tirta.mandira@obatku.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'dokter',
        ]);
        $dokter = Dokter::create([
            'user_id' => $userDokter->id,
            'poli' => 'Poli Penyakit Dalam',
        ]);

        // 2. Buat 2 Pasien
        $userPasien1 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti.aminah@gmail.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'pasien',
        ]);
        $pasien1 = Pasien::create([
            'user_id' => $userPasien1->id,
            'nik' => '3509123456713012',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1990-05-12', // Umur sekitar 36 thn
        ]);

        $userPasien2 = User::create([
            'name' => 'Bagas Saputra',
            'email' => 'bagas.saputra@gmail.com',
            'password' => Hash::make('rahasia123'),
            'role' => 'pasien',
        ]);
        $pasien2 = Pasien::create([
            'user_id' => $userPasien2->id,
            'nik' => '3509123456756112',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2005-11-20', // Umur sekitar 20 thn
        ]);

        // 3. Buat Rekam Medis
        $rm1 = RekamMedis::create([
            'pasien_id' => $pasien1->id,
            'dokter_id' => $dokter->id,
            'keluhan_utama' => "Sakit pinggang",
            'diagnosa' => "lumbar hurt"
            // Asumsi ada kolom keluhan/diagnosa di tabelmu, jika tidak ada, hapus baris ini
        ]);

        $rm2 = RekamMedis::create([
            'pasien_id' => $pasien2->id,
            'dokter_id' => $dokter->id,
            'keluhan_utama' => "Sakit kepala",
            'diagnosa' => "vertigo"
        ]);

        // 4. Buat 3 Resep dengan variasi status dan urgensi
        // Resep 1: Menunggu & Normal
        Resep::create([
            'rekam_medis_id' => $rm1->id,
            'kode_resep' => 'RSP-1001',
            'urgensi' => 'Normal',
            'status' => 'Menunggu',
            'created_at' => Carbon::now()->subMinutes(30),
        ]);

        // Resep 2: Disiapkan & CITO (Urgensi Tinggi)
        Resep::create([
            'rekam_medis_id' => $rm2->id,
            'kode_resep' => 'RSP-1002',
            'urgensi' => 'Segera (Cito)',
            'status' => 'Disiapkan',
            'created_at' => Carbon::now()->subMinutes(10),
        ]);

        // Resep 3: Selesai (Agar masuk ke Tab Riwayat Selesai)
        Resep::create([
            'rekam_medis_id' => $rm1->id,
            'kode_resep' => 'RSP-1003',
            'urgensi' => 'Normal',
            'status' => 'Selesai',
            'created_at' => Carbon::now()->subDays(1), // Dibuat kemarin
        ]);
    }
}
