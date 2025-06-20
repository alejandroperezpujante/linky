<?php

use App\Models\Link;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('dashboard is not accesible for guests', function () {
    get(route('dashboard'))
        ->assertStatus(302)
        ->assertRedirectToRoute('login');
});

test('dashboard renders for users', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $links = Link::factory()->count(6)->create(['user_id' => $user->id]);
    $links = $links->sortByDesc('created_at')->take(5);

    actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertViewIs('dashboard')
        ->assertViewHas('user', $user)
        ->assertViewHas('links', $links);
});
