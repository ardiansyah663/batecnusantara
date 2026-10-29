<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->foreignId('kategori_id')->constrained('video_kategori')->restrictOnDelete();
            $table->string('sumber', 20)->default('youtube'); // youtube atau upload
            $table->string('youtube_url')->nullable();
            $table->string('status', 20)->default('draft');
            $table->timestamp('terbit_pada')->nullable();
            $table->timestamps();
            $table->index(['status', 'terbit_pada']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video');
    }
};
