<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TesWhatsApp extends Command
{
    protected $signature = 'tes:wa';
    protected $description = 'Uji coba kirim pesan WhatsApp via Fonnte';

    public function handle()
    {
        $this->info('Mencoba mengirim pesan WhatsApp...');

        $noHpTujuan = '082244496190';

        $pesan = "Halo! Ini adalah notifikasi pengingat dari sistem Obatku. 💊\n\nWaktunya meminum obat Anda.";

        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => env('WA_ACCESS_TOKEN')
            ])
            ->post('https://api.fonnte.com/send', [
                'target' => $noHpTujuan,
                'message' => $pesan,
                'countryCode' => '62',
            ]);

        if ($response->successful()) {
            $hasil = $response->json();
            if ($hasil['status'] == true) {
                $this->info("✅ Berhasil! Pesan sedang dikirim.");
            } else {
                $this->error("❌ Gagal terkirim. Alasan: " . $hasil['reason']);
            }
        } else {
            $this->error("❌ Terjadi kesalahan jaringan.");
        }
    }
}
