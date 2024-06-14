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

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
           // $table->bigInteger('disease_id');
            $table->foreignId('disease_id')->references('id')->on('diseases');
            $table->longText('disease_question');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints(); // Disable foreign key constraints

        Schema::dropIfExists('questions'); // Drop the table

        Schema::enableForeignKeyConstraints(); // Re-enable foreign key constraints
    }
};
