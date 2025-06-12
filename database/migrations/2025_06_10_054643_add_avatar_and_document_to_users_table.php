<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_avatar_and_document_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom untuk menyimpan path foto profil tukang
            $table->string('avatar_path')->nullable()->after('remember_token');

            // Kolom untuk menyimpan path file KTP atau dokumen identitas lainnya
            $table->string('identity_document_path')->nullable()->after('avatar_path');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_path', 'identity_document_path']);
        });
    }
};