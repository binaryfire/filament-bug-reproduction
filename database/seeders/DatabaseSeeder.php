<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Statistic;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SubStatistic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

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
    }
}
