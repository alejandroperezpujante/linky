<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Link;
use Illuminate\Support\Facades\App;
use App\Models\User;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->environment('local', 'development')) {
            $user = User::first();
            if ($user) {
                Link::factory()->count(20)->create(['user_id' => $user->id]);
            }
        }
    }
}
