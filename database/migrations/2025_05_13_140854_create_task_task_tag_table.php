<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_task_tag', function (Blueprint $table) {
            $table->uuid('task_id');
            $table->uuid('task_tag_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('task_tag_id')->references('id')->on('task_tags')->onDelete('cascade');

            $table->primary(['task_id', 'task_tag_id']);
        });
    }
};
