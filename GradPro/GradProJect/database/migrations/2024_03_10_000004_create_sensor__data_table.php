<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    #this is databasefd
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sensor__data', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('oxygen_rate');
            $table->smallInteger('heart_rate');
            $table->smallInteger('clieus');
            $table->float('prediction')->nullable(); // Column to store the prediction result
            $table->timestamps();
            // $table->foreignId('oxygen_generator_id')->constrained()->onDelete('cascade');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('sensor__data');
        Schema::enableForeignKeyConstraints();
        
    }
};
