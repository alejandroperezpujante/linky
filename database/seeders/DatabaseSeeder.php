<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\App;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('local', 'development')) {
            User::factory()->create(['email' => 'test@example.com']);
            $this->call(LinkSeeder::class);
        }
    }
}
