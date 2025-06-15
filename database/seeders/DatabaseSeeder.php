<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Code;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
