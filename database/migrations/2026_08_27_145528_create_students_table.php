<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Creates a students table using Laravel Migrations[cite: 1]
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // id[cite: 1]
            $table->string('student_id')->unique(); // student_id[cite: 1]
            $table->string('first_name'); // first_name[cite: 1]
            $table->string('middle_name')->nullable(); // middle_name[cite: 1]
            $table->string('last_name'); // last_name[cite: 1]
            $table->string('email')->unique(); // email[cite: 1]
            $table->string('mobile_number'); // mobile_number[cite: 1]
            $table->string('gender'); // gender[cite: 1]
            $table->date('date_of_birth'); // date_of_birth[cite: 1]
            $table->string('program'); // program[cite: 1]
            $table->string('year_level'); // year_level[cite: 1]
            $table->text('address'); // address[cite: 1]
            $table->string('profile_picture'); // profile_picture[cite: 1]
            $table->timestamps(); // created_at, updated_at[cite: 1]
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};