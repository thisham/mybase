<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen flex flex-col">
    <div class="topnav">
        <div class="button-container">
            <a class="clickable @if (Route::is('main.dashboard')) active @endif" href="{{ route('main.dashboard') }}">
                {{ __('display.navigation.dashboard') }}
            </a>
            <a class="clickable @if (Route::is('financial.incomes') ||
                    Route::is('financial.loans') ||
                    Route::is('financial.billings') ||
                    Route::is('financial.payment')) active @endif"
                href="{{ route('financial.incomes') }}">
                {{ __('display.navigation.financial') }}
            </a>
            <a class="clickable @if (Route::is('auth.sign-out')) active @endif" href="{{ route('auth.sign-out') }}">
                {{ __('display.navigation.sign-out') }}
            </a>
        </div>
    </div>

    <div class="px-12 mt-20 mb-auto">
        @yield('content')
    </div>

    <footer class="w-full h-12 flex items-center justify-center">
        &copy; 2023 Divisi Anggaran Keuangan
    </footer>

    @stack('scripts')
</body>

</html>
