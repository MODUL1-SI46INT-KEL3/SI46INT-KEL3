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
    Schema::table('doctor', function (Blueprint $table) {
        if (Schema::hasColumn('doctor', 'working_hours')) {
            $table->dropColumn('working_hours');
        }
    });
}

public function down(): void
{
    Schema::table('doctor', function (Blueprint $table) {
        $table->string('working_hours')->nullable();
});
}
};