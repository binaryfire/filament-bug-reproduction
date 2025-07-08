<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Code extends Model
{
    protected $table = 'code';

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($code) {
            if (Auth::check()) {
                $code->user_id = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
