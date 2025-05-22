<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('patient_id')->constrained('patient')->onDelete('cascade');
            $table->string('item');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['Credit Card', 'Debit Card', 'Cash', 'Insurance', 'Online Payment']);
            $table->enum('payment_status', ['Pending', 'Completed', 'Failed', 'Refunded']);
            $table->timestamp('payment_date')->useCurrent();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}