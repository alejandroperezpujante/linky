<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Linky</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'vendor/picocss/pico/css/pico.css'])
    @endif
</head>
<body class="container-fluid">
<main class="container">
    <h1>Login</h1>
    <p>Enter your account credentials bellow.</p>
    <p>If you don't have an user yet, one will be created.</p>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Log In</button>
    </form>
</main>
</body>
</html>
