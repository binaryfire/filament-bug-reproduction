<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaskTag extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
