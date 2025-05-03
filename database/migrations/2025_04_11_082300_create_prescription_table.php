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
        Schema::create('prescription', function (Blueprint $table) {
            $table->id('prescription_id');
            $table->string('dosage', 255);
            $table->string('instructions', 255);
            $table->date('issue_date');
            $table->foreignId('PatientUser_id')->constrained('patient')->onDelete('cascade');
            $table->foreignId('DoctorUser_id')->constrained('doctor')->onDelete('cascade');
            $table->foreignId('MedicinePrescription_id')->nullable()->constrained('medicine')->onDelete('set null');
            $table->string('prescription_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription');
    }
};
