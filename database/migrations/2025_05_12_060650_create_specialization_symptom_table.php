<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializationSymptomTable extends Migration
{
    public function up()
    {
        Schema::create('specialization_symptom', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('specialization_id') 
                  ->constrained('specializations') 
                  ->onDelete('cascade'); 
            $table->foreignId('symptom_id') 
                  ->constrained('symptoms') 
                  ->onDelete('cascade'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialization_symptom');
    }
}