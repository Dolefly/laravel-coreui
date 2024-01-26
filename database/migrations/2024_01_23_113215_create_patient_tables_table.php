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
        Schema::create('patient_tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->string('guardianName');
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('iDnumber');
            $table->string('phone');
            $table->string('insurer_id');
        
            $table->string('county');
            $table->string('residence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_tables');
    }
};
