<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\User;
use App\LinkStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => implode(' ', fake()->words()),
            'original_url' =>  fake()->url(),
            'short_code' => Str::random(8),
            'status' => fake()->randomElement(LinkStatus::values()),
        ];
    }

    public function withUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory(),
            ];
        });
    }
}
