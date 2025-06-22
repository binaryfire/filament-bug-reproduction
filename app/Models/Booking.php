<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [
        'id',
    ];

    protected function casts()
    {
        return [
            'date' => 'date',
            'date_of_birth' => 'date',
            'date_of_wedding' => 'date',
        ];
    }
}
