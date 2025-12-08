<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('name')->nullable(); // Untuk user yang belum login
            $table->string('email')->nullable(); // Untuk user yang belum login

            // Foreign key untuk user yang login (nullable)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Polymorphic relationships untuk News dan TitipTulisan
            $table->morphs('commentable'); // sudah otomatis membuat index

            $table->timestamps();
            $table->softDeletes();

            // Index tambahan untuk performa query user_id
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
