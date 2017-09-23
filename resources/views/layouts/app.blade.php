<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    @yield('links')

</head>
<body>
    <div id="wrapper">
    
    <section id="header">
        <div class="container-fluid">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                  <a class="navbar-brand" href="{{route('welcome')}}">Photo Taker</a>
                </div>
                <ul class="nav navbar-nav">
                  <li class="{{ (Route::is('home') ? 'active' : '') }}"><a href="{{route('home')}}">Home</a></li>
                  <li class="{{ (Route::is('showPhotos') ? 'active' : '') }}"><a href="{{route('showPhotos')}}">Show photos</a></li>
                </ul>
            </nav>
         </div>
     </section>


     <section id="content">
         <div class="container">
            @yield('content')
         </div>
     </section>

    </div>
                   
     <section id="footer">
        <div class="container-fluid text-center">
            <p> © 2017 Mateusz Szarata, mateusz.szarata@op.pl</p>
        </div>
     </section>


            
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')   
</body>
</html>
