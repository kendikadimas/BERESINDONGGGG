<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beresindong - Repairing Services</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">
    <div id="app">
        <repairing-page></repairing-page> {{-- Ini akan merender komponen halaman Repairing --}}
    </div>

    @vite('resources/js/app.js')
</body>
</html>