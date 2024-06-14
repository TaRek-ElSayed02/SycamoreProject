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
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->text('disease_name');
            //$table->bigInteger('patient_id');
            $table->foreignId('patient_id')->references('id')->on('patients')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('diseases');
        Schema::enableForeignKeyConstraints();
    }
};
