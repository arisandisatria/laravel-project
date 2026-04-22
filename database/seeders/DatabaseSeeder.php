<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Obat;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@obatku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'dr. Andi Hermawan',
            'email' => 'dokter@obatku.com',
            'password' => Hash::make('password'),
            'role' => 'dokter',
        ]);

        User::create([
            'name' => 'Apt. Aris',
            'email' => 'apoteker@obatku.com',
            'password' => Hash::make('password'),
            'role' => 'apoteker',
        ]);

        $pasienUser = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pasien@obatku.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        Pasien::create([
            'user_id' => $pasienUser->id,
            'nik' => '3509123456780001',
            'tanggal_lahir' => '1980-05-15',
            'jenis_kelamin' => 'Laki-laki',
        ]);

        Obat::factory(20)->create();
    }
}
