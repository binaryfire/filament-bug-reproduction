<?php

namespace App\Models;

use App\Models\SubStatistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the sub-statistic associated with the statistic.
     */
    public function subStatistic(): HasOne
    {
        return $this->hasOne(SubStatistic::class);
    }

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

        $subStatData = fake()->sentence(10);

        $this->subStatistic()->updateOrCreate(
            [],
            ['data' => $subStatData]
        );
    }
}
