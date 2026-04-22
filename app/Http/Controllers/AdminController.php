<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPengguna = User::count();
        $totalDokter = User::where('role', 'dokter')->count();
        $totalApoteker = User::where('role', 'apoteker')->count();
        $totalPasien = User::where('role', 'pasien')->count();
        $aktivitasLogin = User::whereNotNull('last_login_at')
                              ->orderBy('last_login_at', 'desc')
                              ->take(5)
                              ->get();

        return view('admin.index', compact(
            'totalPengguna',
            'totalDokter',
            'totalApoteker',
            'totalPasien',
            'aktivitasLogin'
        ));
    }

    public function backupDatabase()
    {
        $databaseName = env('DB_DATABASE');
        $userName = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $fileName = 'backup-obatku-' . date('Y-m-d_H-i-s') . '.sql';
        $storagePath = storage_path('app/private/' . $fileName);

        $passwordParam = $password ? "-p{$password}" : "";

        $command = "C:\\xampp\\mysql\\bin\\mysqldump.exe -u {$userName} {$passwordParam} {$databaseName} > \"{$storagePath}\"";

        exec($command, $output, $returnVar);

        if (file_exists($storagePath) && filesize($storagePath) > 0) {
            return response()->download($storagePath)->deleteFileAfterSend(true);
        } else {
            if(file_exists($storagePath)) {
                unlink($storagePath);
            }
            return back()->with('error', 'Gagal melakukan backup. Pastikan perintah mysqldump dikenali oleh sistem Windows Anda.');
        }
    }
}
