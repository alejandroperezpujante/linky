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
<header class="app-header">
    <h2>Linky</h2>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit">Log Out</button>
    </form>
</header>

<main class="container">
    <h1>New Link</h1>
    <a href="{{ route('dashboard') }}">
        Go to Dashboard
    </a>

    <form action="{{ route('links.store') }}" method="post">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="original_url">Original URL</label>
        <input type="url" name="original_url" id="original_url" required>
        @error('original_url')
            <p>{{ $message }}</p>
        @enderror

        <label for="status">Status</label>
        <select name="status" id="status">
            @foreach($status_options as $status_option)
                <option value="{{ $status_option['value'] }}">{{ $status_option['label'] }}</option>
            @endforeach
        </select>
        @error('status')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Create Link</button>
    </form>
</main>
</body>
</html>
