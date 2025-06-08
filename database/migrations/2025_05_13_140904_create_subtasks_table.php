<?php

declare(strict_types=1);

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
        Schema::create('subtasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('task_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }
};
