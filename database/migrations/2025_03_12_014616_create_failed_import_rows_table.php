<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Filament failed import rows table.
 *
 * Note: This is a modified version of the one from
 * the Filament package.
 * 
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('failed_import_rows', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id')->nullable()->index();
            $table->jsonb('data');
            $table->foreignId('import_id')->constrained()->cascadeOnDelete();
            $table->text('validation_error')->nullable();
            $table->timestamps();
        });
    }
};
