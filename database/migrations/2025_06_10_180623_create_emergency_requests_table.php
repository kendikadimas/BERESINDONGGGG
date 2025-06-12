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
    Schema::create('emergency_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users'); // Customer yang meminta
        // Tukang yang menerima pekerjaan, bisa null saat awal
        $table->foreignId('tukang_id')->nullable()->constrained('users'); 
        $table->text('description');
        $table->string('photo_path')->nullable(); // Path foto bukti masalah
        $table->enum('status', ['pending', 'accepted', 'in_progress', 'completed'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_requests');
    }
};
