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
        Schema::create('service_user', function (Blueprint $table) {
        $table->primary(['service_id', 'user_id']); // Primary key gabungan

        $table->foreignId('service_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Ini adalah ID tukang

        $table->text('description')->nullable(); // Deskripsi spesifik dari tukang
        $table->decimal('price', 10, 2); // Harga yang ditetapkan tukang
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_user_pivot');
    }
};
