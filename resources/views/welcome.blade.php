<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Styles -->
        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                display: flex;
                flex-flow: row nowrap;

            }
            nav{
                width: 15%;
                height: 100vh;
            }
            nav ul{
                width: 100%;
            }
            nav ul li{
                width: 100%;
            }
            nav ul li a{
                display: block;
                width: 100%;
                padding: 20px;
                text-align: center;
                line-height: 30px;
                text-decoration: none;
                font-weight: bolder;
            }
            .content{
                width: 80%;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="{{ route('sucursales') }}">Sucursales</a></li>
                <li><a href="{{ route('empleados') }}">empleados</a></li>
                <li><a href="{{ route('clientes') }}">clientes</a></li>
                <li><a href="{{ route('productos') }}">productos</a></li>
                <li><a href="{{ route('pedidos') }}">pedidos</a></li>
            </ul>
        </nav>
        <div class="content" style="padding: 30px; border: 2px solid #ccc;">
            @yield('content')
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        @yield('script')
    </body>
</html>
