<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan_tour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_tour')->restrictOnDelete();
            $table->string('kode_pesanan', 20)->unique();
            $table->string('nama_wisatawan');
            $table->string('whatsapp', 20)->index(); // tidak unik: satu HP bisa dipakai beberapa pendaftar
            $table->date('tanggal_tour');
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('harga_saat_pesan'); // diambil dari server saat pesan
            $table->timestamp('persetujuan_pada');
            $table->string('status', 20)->default('pending')->index();
            $table->timestamps();
            $table->index(['paket_id', 'tanggal_tour']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan_tour');
    }
};
