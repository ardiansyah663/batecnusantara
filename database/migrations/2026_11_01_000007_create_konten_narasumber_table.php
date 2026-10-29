<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konten_narasumber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_budaya_id')->constrained('konten_budaya')->cascadeOnDelete();
            $table->foreignId('narasumber_id')->constrained('narasumber')->restrictOnDelete();
            $table->unsignedInteger('urutan')->default(0);
            $table->unique(['konten_budaya_id', 'narasumber_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_narasumber');
    }
};
