<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $attributes['title'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen flex flex-col">
    <div class="topnav">
        <div class="button-container">
            <a class="clickable @if (Route::is('auth.sign-up')) : active @endif"
                href="{{ route('auth.sign-up') }}">Sign Up</a>
            <a class="clickable @if (Route::is('auth.sign-in')) : active @endif"
                href="{{ route('auth.sign-in') }}">Sign In</a>
        </div>
    </div>

    <div class="px-12 mt-20 mb-auto">
        {{ $slot }}
    </div>

    <footer>test</footer>
</body>

</html>
