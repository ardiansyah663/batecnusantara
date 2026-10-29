<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_budaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_budaya_id')->constrained('konten_budaya')->cascadeOnDelete();
            $table->string('tipe', 20); // foto, audio, video_upload, video_youtube
            $table->string('youtube_url')->nullable();
            $table->unsignedInteger('ukuran_kb')->nullable();
            $table->string('caption')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_budaya');
    }
};
