<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Backpack for Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
                color: #467fd0;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .m-t-lg {
                margin-top: 60px;
            }
            a:hover {
                color: #7C69EF;
            }
        </style>

        {{-- Plausibile.io analytics, proxied through a CloudFlare Worker --}}
        <script defer data-domain="demo.backpackforlaravel.com" src="https://sweet-surf-fd04.dhcfw.workers.dev/js/script.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="https://backpackforlaravel.com/presentation/img/backpack/logos/backpack_logo.svg" width="278px" alt="Backpack for Laravel">
                </div>

                <div class="links">
                    <a href="{{ backpack_url() }}">Login</a>
                    <a target="_blank" href="https://backpackforlaravel.com/docs">Docs</a>
                    <a target="_blank" href="https://github.com/laravel-backpack/crud">GitHub</a>
                    <a target="_blank" href="https://backpackforlaravel.com/contact">Contact</a>
                </div>

                <div class="m-t-lg">
                    * No front-end pages are provided in this demo. Only the admin panel.
                </div>
            </div>
        </div>
    </body>
</html>
