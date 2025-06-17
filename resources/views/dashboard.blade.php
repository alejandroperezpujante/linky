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
<main>
    <p>
        Welcome {{ auth()->user()->email }}
    </p>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit">Log Out</button>
    </form>
</main>
</body>
</html>
