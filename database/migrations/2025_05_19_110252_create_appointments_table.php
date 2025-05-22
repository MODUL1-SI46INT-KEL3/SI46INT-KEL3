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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Foreign key to 'patient' table (singular)
            $table->foreignId('patient_id')->constrained('patient')->onDelete('cascade');

            // Foreign key to 'doctor' table (singular)
            $table->foreignId('doctor_id')->constrained('doctor')->onDelete('cascade');

            // Foreign key to 'schedules' table with custom primary key 'schedule_id'
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('schedule_id')->on('schedules')->onDelete('cascade');

            $table->string('booking_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
