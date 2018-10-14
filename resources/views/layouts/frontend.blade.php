<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Url Shortener</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>

    <!-- Top Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="images/logo.png" class="nav-site-logo site-logo" alt="Url Shortener logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        {{--<a class="nav-link" href="{{ route('get.login') }}">Login</a>--}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Body Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mr-2">
                    <a class="navbar-brand mt-5" href="#"><img src="images/logo.png" class="site-logo img-fluid" alt="Url Shortener logo"></a>
                    <h3 class="mt-5">Welcome To Url Shortener</h3>
                    <h6>Make long url shorter</h6>

                    <div class="body-section mr-2">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-section">
                    <p  class="text-muted text-center">
                        Copyright © <strong>Url Shortener</strong> 2018
                    </p>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</html>