<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('the auth page renders', function () {
    get(route('login'))->assertOk();
});

test('new user registers', function () {
    $credentials = [
        'email' => 'test@example.com',
        'password' => Hash::make('password')
    ];

    post(route('login'), $credentials)->assertRedirectToRoute('dashboard');

    assertDatabaseHas('users', ['email' => $credentials['email']]);
    assertAuthenticatedAs(User::whereEmail($credentials['email'])->first());
});

test('existing user logs in', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    assertDatabaseHas('users', ['email' => $user->email]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password'
    ])->assertRedirectToRoute('dashboard');

    assertAuthenticatedAs($user);
});

test('invalid input returns errors', function () {
    post(route('login'), [
        'email' => 'invalidemail.com',
    ])->assertSessionHasErrors(['email']);

    $user = User::factory()->create(['email' => 'test@example.com']);
    assertDatabaseHas('users', ['email' => $user->email]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password'
    ])->assertSessionHasErrors(['email']);
});
