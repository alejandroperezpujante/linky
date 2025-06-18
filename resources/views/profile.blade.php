<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Linky</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @endif
</head>
<body>
<header>
    <h2>Linky</h2>
    <p>Welcome {{ $user->email }}</p>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit">Log Out</button>
    </form>
</header>
<main>
    <h1>My Profile</h1>


    <section>
        <h2>Email Address</h2>

        <form action="{{ route('profile.email.update') }}" method="post">
            @csrf

            <label for="current_email">Current Email</label>
            <input type="email" name="current_email" id="current_email" value="{{ $user->email }}" readonly required>
            @error('current_email')
            <p>{{ $message }}</p>
            @enderror

            <label for="new_email">New Email</label>
            <input type="email" name="new_email" id="new_email" required>
            @error('new_email')
            <p>{{ $message }}</p>
            @enderror

            <button type="submit">Update Email</button>
        </form>
    </section>

    <section>
        <h2>Password</h2>

        <form action="{{ route('profile.password.update') }}" method="post">
            @csrf

            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" required>
            @error('new_password')
            <p>{{ $message }}</p>
            @enderror

            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
            @error('new_password_confirmation')
            <p>{{ $message }}</p>
            @enderror

            <button type="submit">Update Password</button>
        </form>
    </section>
</main>
</body>
</html>
