<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\TaskTag;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Task extends Model
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
            'due_date' => 'datetime',
            'completed_at' => 'datetime',
            'metadata' => AsCollection::class,
            'priority' => 'integer',
        ];
    }

    /**
     * Get the subtasks for this task.
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask::class);
    }

    /**
     * Determine if the task is completed.
     */
    public function isCompleted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === 'completed',
        );
    }

    /**
     * Mark the task as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    /**
     * Mark the task as pending.
     */
    public function markAsPending(): void
    {
        $this->update([
            'status' => 'pending',
            'completed_at' => null,
        ]);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(TaskTag::class);
    }

    /**
     * Get the formatted metadata.
     */
    protected function metadata(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? json_decode($value, true) : new Collection(),
            set: fn ($value) => is_array($value) || $value instanceof Collection ? json_encode($value) : $value,
        );
    }
}
