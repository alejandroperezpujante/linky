<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'vendor/picocss/pico/css/pico.css'])
    @endif
</head>
<body>
    <div class="container" style="text-align:center; margin-top:10vh;">
        <h1>404</h1>
        <h2>Link Not Found</h2>
        <p>The link you are looking for does not exist or may have been removed.</p>
        <a href="/" class="btn btn-primary">Go to Home</a>
    </div>
</body>
</html> 