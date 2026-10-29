<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('ringkasan', 300)->nullable();
            $table->longText('isi')->nullable();
            $table->foreignId('kategori_id')->constrained('berita_kategori')->restrictOnDelete();
            $table->foreignId('penulis_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 20)->default('draft');
            $table->timestamp('terbit_pada')->nullable();
            $table->timestamps();
            $table->index(['status', 'terbit_pada']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
