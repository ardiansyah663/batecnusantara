<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_destinasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_tour')->cascadeOnDelete();
            $table->foreignId('mitra_id')->constrained('mitra_wisata')->restrictOnDelete();
            $table->unsignedInteger('urutan')->default(0);
            $table->string('judul_kunjungan');
            $table->text('deskripsi_kunjungan')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->timestamps();
            $table->index(['paket_id', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_destinasi');
    }
};
