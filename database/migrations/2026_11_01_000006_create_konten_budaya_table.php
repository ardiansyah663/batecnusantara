<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konten_budaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('budaya_kategori')->restrictOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('deskripsi')->nullable();
            $table->string('status', 20)->default('draft');
            $table->boolean('unggulan')->default(false)->index();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
            $table->index(['kategori_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_budaya');
    }
};
