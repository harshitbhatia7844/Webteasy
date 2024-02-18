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
        Schema::create('q_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('test_id');
            $table->string('question_id');
            $table->string('s_answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_attempts');
    }
};
