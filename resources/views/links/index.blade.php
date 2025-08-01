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
        <section>
            <h1>My Links</h1>

            @if($links->count() > 0)
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Short Code</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Usage</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>{{ $link->name }}</td>
                            <td>
                                <a href="{{ $link->original_url }}" target="_blank">
                                    {{ Str::limit($link->original_url, 50) }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('link.external', ['short_code' => $link->short_code]) }}" target="_blank">
                                    {{ $link->short_code }}
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('links.toggle', $link) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="checkbox"
                                        role="switch"
                                        id="status"
                                        name="status"
                                        oninput="this.form.submit()"
                                        @checked($link->isActive())
                                    />
                                </form>
                            </td>
                            <td>
                                {{ $link->created_at->diffForHumans() }}
                            </td>
                            <td>
                                {{ $link->usage_count }}
                            </td>
                            <td class="table-actions">
                                <form method="POST" action="{{ route('links.destroy', $link) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="{{ route('links.edit', $link) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $links->links() }}
            @else
                <p>You haven't created any links yet.</p>
                <a href="{{ route('links.create') }}">Create your first link</a>
            @endif
        </section>
    </main>
</body>
</html>
