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
        Schema::table('roles', function (Blueprint $table) {
            // If the roles table already has a company_id column
            // but is referencing a non-existent company_id column in companies
            // Update it to reference the 'id' column in companies.

            $table->dropForeign(['company_id']);  // Drop the existing foreign key if it exists
            $table->foreignId('company_id')
                  ->constrained('companies') // This will now reference 'id' in 'companies'
                  ->onDelete('cascade');     // Optionally specify the deletion behavior
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['company_id']);  // Drop the foreign key constraint
            $table->dropColumn('company_id');    // Optionally, drop the column
        });
    }
};