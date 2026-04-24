<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->cascadeOnDelete();
            $table->foreignId('obat_id')->nullable()->constrained('obats')->onDelete('cascade');
            $table->foreignId('apoteker_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['Menunggu', 'Disiapkan', 'Selesai'])->default('Menunggu');
            $table->enum('urgensi', ['Normal', "Semua Urgensi", "Segera (Cito)"])->default('Normal');
            $table->string('kode_resep');
            $table->integer('jumlah')->default(1);
            $table->string('aturan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
