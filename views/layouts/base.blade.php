<!doctype html>
<html lang="fr">

<head>
    <title>@yield('title', setting('title', 'Funasitien'))</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="#ff5555">
    <meta name="author" content="Funasitien">
    <link rel="icon" type="image/png" href="{{ favicon() }}">
    <link rel="shortcut icon" type="image/png" href="{{ favicon() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')
    <link rel="stylesheet" href="{{ theme_asset('style.css') }}" />
    <link rel="stylesheet" href="/fonts/Satoshi.css" />
    <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" >
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    <link href="https://cdn.jsdelivr.net/combine/npm/daisyui@beta/components/range.css" rel="stylesheet" type="text/css" />

    @stack('styles')
    @stack('scripts')
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body class="overflow-x-clip">
            @include('elements.navbar')
            @include('elements.menu')

        @yield('app')

            @include('elements.footer')
            @include('elements.navigation')
    
</body>
@stack('footer-scripts')
</html>
