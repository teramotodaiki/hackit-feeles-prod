<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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
        @if(session('message'))
        <div style="color: red">{{ session('message') }}</div>
        @endif

        <div class="flex-center position-ref full-height">
            @if (Route::has('login') && env('PUBLIC_REGISTER', false))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">
                        @lang('menu.login')
                    </a>
                    <a href="{{ url('/register') }}">
                        @lang('menu.register')
                    </a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                {{ config('app.name', 'Laravel') }}
                </div>

                @if (isset($invitation))
                <div class="links m-b-md">
                    <a href="/invitations">
                        @lang('form.join')
                    </a>
                </div>
                @endif

                <div class="links">
                    <a href="/contents">@lang('menu.works')</a>
                    <a href="/users">@lang('menu.member')</a>
                    <a href="/studentLogin">@lang('menu.login')</a>
                    <a href="/admin">@lang('menu.admin')</a>
                </div>
            </div>
        </div>
    </body>
</html>
