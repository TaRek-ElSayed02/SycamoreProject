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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();    
            $table->text('Description');
            $table->timestamp('CreatedAt');
            $table->date('Date');
            //$table->bigInteger('Patient_id');
            $table->foreignId('Patient_id')->references('id')->on('patients')->constrained()->onDelete('cascade');
            //$table->bigInteger('Doctor_id');
            $table->foreignId('Doctor_id')->references('id')->on('doctors')->constrained()->onDelete('cascade');
            $table->string('Patient_Name');
            //$table->foreignId('doctor_id')->constrained()->onDelete('cascade');
           // $table->foreignId('patient_id')->constrained()->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reports');
        Schema::enableForeignKeyConstraints(); 
    }
};
