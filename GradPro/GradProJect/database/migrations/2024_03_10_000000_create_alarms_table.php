<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /
    //  * Run the migrations.
    //  */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('alarms', function (Blueprint $table) {
            $table->id()->unsigned()->foreign('Doctor.Alarm_id');
            $table->string('Message');
            $table->timestamp('Time');
            //$table->foreignId('doctor_id')->constrained()->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    // /
    //  * Reverse the migrations.
    //  */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('alarms');
        Schema::enableForeignKeyConstraints(); 
    }
};