<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Gestión de Contratistas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style >
.centrado-porcentual {
    position: absolute;
    left: 50%;
    top: 50%;
    width:800px;
    height: 500px;
     transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);

   }
    </style>
</head>
<body>                     
    <div class="container">
        
                <main class="centrado-porcentual">
                    @yield('content')
                </main>
            
    </div>
</body>
</html>
