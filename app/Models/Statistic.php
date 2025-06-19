<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    protected $attributes = [
        'data' => '{}',
    ];

    public function refreshData(): void
    {
        $this->data = [
            'Jan' => rand(10, 100),
            'Feb' => rand(10, 100),
            'Mar' => rand(10, 100),
            'Apr' => rand(10, 100),
            'May' => rand(10, 100),
            'Jun' => rand(10, 100),
        ];

        $this->save();
    }
}
