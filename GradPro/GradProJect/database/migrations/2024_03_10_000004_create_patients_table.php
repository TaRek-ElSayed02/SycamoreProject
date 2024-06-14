<?php
#this is patient table
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('Email')->nullable();
            $table->string('Password')->nullable();
            //$table->bigInteger('Doctor_id');
            $table->foreignId('Doctor_id')->references('id')->on('doctors');
            $table->bigInteger('OxyGenerator_id')->nullable();
            $table->smallInteger('Age')->nullable();
            $table->smallInteger('Height')->nullable();
            $table->smallInteger('Weight')->nullable();
            $table->smallInteger('Temperature')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->string('Password_Confirmation')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('patients');
        Schema::enableForeignKeyConstraints(); 
    }
};
