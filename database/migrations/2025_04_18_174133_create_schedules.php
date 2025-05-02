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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // Define the columns first
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');

            $table->date('date');
            $table->time('time');
            $table->string('status'); // e.g., pending, confirmed, completed, cancelled
            $table->timestamps();

            // Add foreign key constraints after the columns exist
            $table->foreign('doctor_id')->references('id')->on('doctor')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
