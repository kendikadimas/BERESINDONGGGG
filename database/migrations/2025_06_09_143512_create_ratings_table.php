<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_ratings_table.php
public function up(): void
{
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Customer yang memberi rating
        $table->foreignId('tukang_id')->constrained('users')->cascadeOnDelete(); // Tukang yang menerima rating
        $table->unsignedTinyInteger('rating'); // Angka 1-5
        $table->text('comment')->nullable(); // Pesan/detail dari customer
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
