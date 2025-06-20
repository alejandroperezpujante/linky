<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('dashboard is not accesible for guests', function () {
    get(route('profile'))
        ->assertStatus(302)
        ->assertRedirectToRoute('login');
});

test('dashboard renders for users', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);

    actingAs($user)
        ->get(route('profile'))
        ->assertOk()
        ->assertViewIs('profile')
        ->assertViewHas('user', $user);
});

test('user can update their email', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);

    actingAs($user)
        ->post(route('profile.email.update', [
            'current_email' => 'test@example.com',
            'new_email' => 'test_two@example.com'
        ]))
        ->assertStatus(302)
        ->assertRedirectBack();

    assertDatabaseHas('users', ['email' => 'test_two@example.com']);

});

test('user can update their pasword', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);

    actingAs($user)
        ->post(route('profile.password.update', ['new_password' => 'password123']))
        ->assertStatus(302)
        ->assertRedirectToRoute('landing');

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password'
    ])->assertRedirectToRoute('dashboard');

    $user->refresh();
    assertAuthenticatedAs($user);
});
