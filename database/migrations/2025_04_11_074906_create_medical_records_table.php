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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('record_id');
            $table->string('notes', 255)->nullable();
            $table->date('visit_date');
            $table->time('visit_time')->nullable();
            $table->foreignId('PatientUser_id')->constrained('patient')->onDelete('cascade');
            $table->foreignId('DoctorUser_id')->constrained('doctor')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
