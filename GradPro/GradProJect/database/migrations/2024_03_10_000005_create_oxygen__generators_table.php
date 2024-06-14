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
        Schema::disableForeignKeyConstraints();
        Schema::create('oxygen__generators', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('Oxygen Level');
            $table->foreignId('SensorData_id')->references('id')->on('sensor__data');
           // $table->bigInteger('Patient_id');
            $table->foreignId('Patient_id')->references('id')->on('patients')->constrained()->onDelete('cascade');
            //$table->foreignId('patient_id')->constrained()->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('oxygen__generators');
        Schema::enableForeignKeyConstraints();
    }
};
