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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('working_hours'); 
            $table->string('password');
            $table->foreignId('specialization_id')
                ->constrained('specializations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('phone', 15)->nullable(); 
            $table->string('license_number', 50)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};