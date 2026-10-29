<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('linimasa_ritual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_budaya_id')->constrained('konten_budaya')->cascadeOnDelete();
            $table->unsignedInteger('urutan')->default(0);
            $table->string('judul_tahap');
            $table->text('deskripsi')->nullable();
            $table->string('waktu_estimasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('linimasa_ritual');
    }
};
