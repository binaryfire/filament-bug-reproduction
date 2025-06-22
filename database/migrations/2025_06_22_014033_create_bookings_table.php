<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('slot_id');
            $table->string('name');
            $table->date('date_of_birth');
            $table->date('date_of_wedding');
            $table->timestamps();
        });
    }
};
