<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('all_users', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('unique_id')->unique();  // Unique identifier for the user
            $table->string('branch');  // Branch
            $table->string('department');  // Department
            $table->string('designation');  // Designation
            $table->string('name');  // Name of the user
            $table->string('address');  // User address
            $table->string('email')->unique();  // Unique email for the user
            $table->string('mobile_number')->nullable();  // Mobile number (optional)
            $table->string('emergency_mobile_number')->nullable();  // Emergency contact number (optional)
            $table->date('joining_date')->nullable();  // Joining date (optional)
            $table->unsignedBigInteger('company_id')->nullable();  // Foreign key for the company (optional)
            $table->string('id_proof')->nullable();  // To store file path of ID proof (optional)
            $table->timestamps();  // Timestamps for created_at and updated_at

            // Foreign key constraint for company (if exists)
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('all_users');
    }
};