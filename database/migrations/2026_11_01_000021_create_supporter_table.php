<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supporter', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('url')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->string('status', 20)->default('aktif')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supporter');
    }
};
