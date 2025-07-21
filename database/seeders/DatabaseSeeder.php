<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Code;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Statistic;
use App\Models\SubStatistic;
use App\Models\TaskTag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        TaskTag::factory(8)->create();

        $htmlContent = file_get_contents(resource_path('seeder-data/exception.html'));

        Code::create([
            'name' => 'Test',
            'code' => $htmlContent,
            'user_id' => 1,
        ]);

        $stat = Statistic::create([
            'name' => 'Test',
            'description' => 'This is a test stat.',
        ]);

        SubStatistic::create([
            'statistic_id' => $stat->id,
        ]);

        $stat->refreshData();

        Booking::create([
            'venue_id' => 1,
            'date' => now(),
            'slot_id' => 1,
            'name' => 'John',
            'date_of_birth' => now()->subYears(20),
            'date_of_wedding' => now()->subYears(5)
        ]);
    }
}
