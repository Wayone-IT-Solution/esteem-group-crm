<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Foreign key to companies table
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Foreign key to roles table
            $table->foreignId('department_id')->constrained()->onDelete('cascade'); // Foreign key to departments table
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_number');
            $table->string('emergency_mobile_number')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('id_proof')->nullable();
            $table->text('address');
            $table->rememberToken(); // For Laravel's "remember me" feature
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}