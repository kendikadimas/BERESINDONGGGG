<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_proof_photo_path_to_warranty_claims_table.php
public function up(): void
{
    Schema::table('warranty_claims', function (Blueprint $table) {
        $table->string('proof_photo_path')->nullable()->after('issue_description');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warranty_claims', function (Blueprint $table) {
            //
        });
    }
};
