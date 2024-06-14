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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('NewPassword')->nullable();
            $table->string('Email')->nullable();
            $table->string('Password')->nullable();
            $table->foreignId('Alarm_id')->nullable()->references('id')->on('alarms');
            $table->foreignId('Notification_id')->nullable()->references('id')->on('notifications');
            $table->string('Password_Confirmation');
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
        Schema::dropIfExists('doctors');
        Schema::enableForeignKeyConstraints();
    }
};
