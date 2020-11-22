<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API BOTS</title>

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
        </style>
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
                    API BOTS
                </div>

                <div class="links">
                    Users  [ {{$countUsers}} ]
                    Bots   [ {{$countBots}} ]
                    <hr>
                    <h1>API HELP</h1>
                    <hr>
                    DOCS: метод:GET, URL:http:{URL}/api/v1/bots
                    <hr>
                    REGISTER: метод:POST, URL:http:{URL}/api/v1/registration
                    <hr>
                    LOGIN  метод:GET, URL:http:{URL}/api/v1/login
                    <hr>
                    LOGOUT метод:POST, URL:http:{URL}/api/v1/logout
                    <hr>
                    ACCOUNT метод:POST, URL:http:{URL}/api/v1/account
                    <hr>
                    ALL BOTS метод:GET, URL:http:{URL}/api/v1/bots/index
                    <hr>
                    DESTROY BOT метод:POST, URL:http:{URL}/api/v1/bots/{id}/destroy
                    <hr>
                    SHOW BOT метод:GET, URL:http:{URL}/api/v1/bots/{id}/show
                    <hr>
                    NEW BOT метод:POST, URL:http:{URL}/api/v1/bots/create
                    <hr>
                    EDIT BOT метод:POST, URL:http:{URL}/api/v1/bots/update
                    <hr>
                </div>
            </div>
        </div>
    </body>
</html>
