<?php

namespace Database\Factories;

use App\Models\TaskTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskTag>
 */
class TaskTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = TaskTag::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'urgent',
                'personal',
                'work',
                'shopping',
                'health',
                'finance',
                'home',
                'travel',
                'family',
                'education',
                'hobby',
                'social',
                'maintenance',
                'planning',
                'research'
            ]),
        ];
    }
}
