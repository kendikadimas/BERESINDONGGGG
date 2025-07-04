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
        Schema::create('services', function (Blueprint $table) {
        $table->id();
        // Langsung definisikan foreign key di sini
        $table->foreignId('service_category_id')->nullable()->constrained('service_categories');
        $table->string('name');
        $table->string('icon_path')->nullable();
        $table->text('description')->nullable();
        $table->decimal('base_price', 10, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
