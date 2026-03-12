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
        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('annual_discount')->default(0);
            $table->string('tagline')->nullable();
            $table->boolean('is_most_popular')->default(false);
            $table->boolean('show_on_landing')->default(true);
            $table->integer('display_order')->default(0);
            $table->string('status')->default('draft');
            $table->jsonb('modules')->nullable();
            $table->integer('max_patients')->nullable();
            $table->integer('max_appointments_per_month')->nullable();
            $table->integer('max_team_seats')->nullable();
            $table->integer('max_lab_referrals_per_month')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
