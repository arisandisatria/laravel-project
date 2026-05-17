<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalObat;
use Illuminate\Support\Facades\Http;

class CekJadwalObat extends Command
{
    protected $signature = 'obat:kirim-pengingat';
    protected $description = 'Mengirim pengingat minum obat via WhatsApp sesuai jadwal';

   public function handle()
    {
        $waktuSekarang = now()->format('H:i');
        $hariIni = now()->toDateString();

        $jadwalAktif = JadwalObat::with(['pasien.user', 'obat'])
            ->where('waktu_minum', $waktuSekarang)
            ->whereDate('tanggal_selesai', '>=', $hariIni)
            ->get();

        if ($jadwalAktif->isEmpty()) {
            $this->info("Tidak ada jadwal minum obat yang aktif pada pukul $waktuSekarang.");
            return;
        }

        foreach ($jadwalAktif as $jadwal) {
            if (!empty($jadwal->pasien->no_hp)) {
                $noHp = $jadwal->pasien->no_hp;
                $namaPasien = $jadwal->pasien->user->name;
                $namaObat = $jadwal->obat->nama_obat;
                $aturan = $jadwal->aturan;

                $this->kirimWA($noHp, $namaPasien, $namaObat, $aturan);
            }
        }

        $this->info("Berhasil memproses pengingat WA.");
    }

    private function kirimWA($noHp, $nama, $obat, $aturan)
    {
        $pesan = "Halo $nama, ini pengingat dari aplikasi Obatku. 💊\n\n";
        $pesan .= "Waktunya meminum obat Anda:\n";
        $pesan .= "▪️ Obat: *$obat*\n";
        $pesan .= "▪️ Aturan: *$aturan*\n\n";
        $pesan .= "Semoga lekas sembuh!";

        Http::withoutVerifying()
            ->withHeaders(['Authorization' => env('WA_ACCESS_TOKEN')])
            ->post('https://api.fonnte.com/send', [
                'target' => $noHp,
                'message' => $pesan,
                'countryCode' => '62',
            ]);
    }
}
