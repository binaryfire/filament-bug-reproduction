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
        Schema::create('sub_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('statistic_id')->constrained('statistics')->cascadeOnDelete();
            $table->text('data')->nullable();
            $table->timestamps();
        });
    }
};
