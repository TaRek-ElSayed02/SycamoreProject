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

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
           // $table->bigInteger('qustions_id');
            $table->foreignId('qustions_id')->references('id')->on('questions')->constrained()->onDelete('cascade');
            //$table->bigInteger('patient_id');
            $table->foreignId('patient_id')->references('id')->on('patients')->constrained()->onDelete('cascade');
            $table->boolean('ques_value');
           
        });

        Schema::enableForeignKeyConstraints();
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); 
        Schema::dropIfExists('answers');
        Schema::enableForeignKeyConstraints(); 
    }
};
