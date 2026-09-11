<!DOCTYPE html>
<html lang="en" data-admin-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Overview') — {{ config('app.name', 'Barbershop') }} Admin</title>
    <script>
        try { if (localStorage.getItem('barbershop-admin-theme') === 'light') document.documentElement.dataset.adminTheme = 'light'; } catch {}
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,600i|instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-ui min-h-screen antialiased" x-data="adminPanel">
    @if (session()->has('message'))
        <x-status-message :type="session('type', 'info')" :message="session('message')" />
    @endif
    <a href="#admin-main" class="admin-button sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50">Skip to content</a>
    @yield('content')
</body>
</html>
