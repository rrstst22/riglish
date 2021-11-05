<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a4d6751d2b.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <div class="logo-box text-center">
            <div class="logo"><a href="{{ url('/') }}">Webエンジニアへの道</a></div>
        </div>

        <div class="arrow" v-on:click='on_arrow=!on_arrow'>
            <i class="fas fa-chevron-right"></i>
        </div>

        <div class="controller border-right" v-bind:class='{onarrow:on_arrow}'>
            <div class="icon"><a href="./"><i class="fas fa-home fa-3x"></i></a></div>
            <div class="icon"><i class="fab fa-twitter fa-3x"></i></div>
            <div class="icon"><a href="import"><i class="fas fa-user-lock fa-3x"></i></a></div>
        </div>
        
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                    <div class="col-md-3">
                        <div class="index">
                            <ul>
                                <li>Messenger</li>
                                <li>Word Test</li>
                                <li>Count Down</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="footer">
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
