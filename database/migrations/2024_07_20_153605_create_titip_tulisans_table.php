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
        Schema::create('titip_tulisans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('category')
                ->nullOnDelete();
            $table->string('nama_pengirim');
            $table->string('email_pengirim');
            $table->string('judul');
            $table->text('isi');
            $table->string('image')->nullable();
            $table->string('status')->default('Pending');
            $table->integer('views')->default(0); // Tambahkan ini
            $table->string('slug')->unique()->nullable(); // Tambahkan ini
            $table->timestamps();

            // Index untuk slug
            $table->index('slug');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titip_tulisans');
    }
};
