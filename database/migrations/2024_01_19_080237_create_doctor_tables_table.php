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
        Schema::create('doctor_tables', function (Blueprint $table) {
            $table->id();
            $table ->string('employeeid')->unique();
            $table->string('name');
            $table->string('position');
            $table->string('phone');
            $table->integer('IdNumber')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_tables');
    }
};
