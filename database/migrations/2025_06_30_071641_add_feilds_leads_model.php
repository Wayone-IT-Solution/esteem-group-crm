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
        Schema::table('lead_models', function (Blueprint $table) {
            $table->string('survey_question')->nullable();
            $table->string('survey_answer')->nullable();
            $table->string('when_do_you_like_to_avail_the_service')->nullable();
            $table->string('car_rego_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_models', function (Blueprint $table) {
            //
        });
    }
};
