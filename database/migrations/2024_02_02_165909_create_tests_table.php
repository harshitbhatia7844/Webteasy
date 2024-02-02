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
        Schema::create('tests', function (Blueprint $table) {
            $table->string('test_id')->autoIncrement()->primary();
            $table->string('name')->nullable();
            $table->string('duration');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->float('negative')->default(0.25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
