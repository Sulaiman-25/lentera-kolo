<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->uuid('device_id');

            // Relasi ke news (opsional)
            $table->foreignId('news_id')->nullable()->constrained()->onDelete('cascade');

            // Relasi ke titip_tulisan (opsional)
            $table->foreignId('titip_tulisan_id')->nullable()->constrained('titip_tulisans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
