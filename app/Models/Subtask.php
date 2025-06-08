<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subtask extends Model
{
    use HasUuids;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Get the task that owns the subtask.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Determine if the subtask is completed.
     */
    public function isCompleted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === 'completed',
        );
    }

    /**
     * Mark the subtask as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    /**
     * Mark the subtask as pending.
     */
    public function markAsPending(): void
    {
        $this->update([
            'status' => 'pending',
            'completed_at' => null,
        ]);
    }
}
