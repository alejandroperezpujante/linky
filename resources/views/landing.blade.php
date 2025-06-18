<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Linky</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['vendor/picocss/pico/css/pico.css'])
        @endif
    </head>
    <body class="container-fluid">
        <main class="container">
            <h1>Linky</h1>
            <p>Easy and straightforward link shortening service.</p>

            <a href="{{ route('login') }}">
                Get Started
            </a>
        </main>
    </body>
</html>
