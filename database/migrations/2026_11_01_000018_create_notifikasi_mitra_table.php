<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi_mitra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan_tour')->cascadeOnDelete();
            $table->foreignId('mitra_id')->constrained('mitra_wisata')->restrictOnDelete();
            $table->string('status_kirim', 20)->default('belum');
            $table->timestamps();
            $table->unique(['pesanan_id', 'mitra_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi_mitra');
    }
};
