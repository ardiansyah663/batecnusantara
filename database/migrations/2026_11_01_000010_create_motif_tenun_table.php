<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motif_tenun', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motif');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('filosofi')->nullable();
            $table->foreignId('narasumber_id')->nullable()->constrained('narasumber')->restrictOnDelete();
            $table->string('link_marketplace')->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->boolean('unggulan')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motif_tenun');
    }
};
