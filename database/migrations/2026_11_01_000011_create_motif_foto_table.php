<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motif_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motif_id')->constrained('motif_tenun')->cascadeOnDelete();
            $table->string('caption')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motif_foto');
    }
};
