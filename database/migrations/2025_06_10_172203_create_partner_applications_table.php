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
    Schema::create('partner_applications', function (Blueprint $table) {
        $table->id();
        // User yang mengajukan diri
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        // Path ke file KTP/dokumen identitas
        $table->string('identity_document_path');
        // Path ke foto profil baru (jika diunggah di sini)
        $table->string('profile_photo_path');
        // Status pengajuan
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->text('rejection_reason')->nullable(); // Alasan jika ditolak admin
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_applications');
    }
};
