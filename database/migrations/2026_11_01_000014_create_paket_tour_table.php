<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_tour', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('deskripsi')->nullable();
            $table->unsignedBigInteger('harga')->default(0); // per orang, rupiah
            $table->string('durasi')->nullable();
            $table->string('status', 20)->default('draft')->index();
            $table->boolean('unggulan')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_tour');
    }
};
