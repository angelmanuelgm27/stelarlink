<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $data['title'] }}</title>

    <!-- Fonts awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anta&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <!-- GENRAL META TAGS -->
    <meta name="description" content="{{ $data['description'] }}" />
    <meta name="robots" content="index">
    <meta name="copyright" content="{{ $data['copyright'] }}">

    <!-- Open Graph / Facebook META TAGS -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $data['title'] }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ $data['description'] }}">

    <!-- Twitter META TAGS -->
    <meta property="twitter:card" content=" summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ $data['title'] }}" />
    <meta property="twitter:description" content="{{ $data['description'] }}" />
    <meta property="twitter:image" content="{{ asset('images/logo.png') }}" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/leaflet.css', 'resources/js/sweetalert2.all.js', 'resources/css/sweetalert2.css'])
</head>

<body>
    <div id="app">

        <main class="position-relative">
            {{-- HEADER COMPONENT --}}
            <x-header></x-header>
            @yield('content')
        </main>

        {{-- FOOTER COMPONENT --}}
        <x-footer></x-footer>

        @include('sweetalert::alert')
        <!-- Leaft -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('jsmap')
        @yield('js')
    </div>
</body>

</html>
