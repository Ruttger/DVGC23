<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SEKE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <!-- Style -->
        <style>  
        body {
            font-family: 'Nunito';
            }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
            }

        .box {
            overflow: hidden;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px 10px 10px 10px; 
            margin-top: 10px;
            } 

        </style>
    </head>
        <body class="" style="background-color:#969696;">
            @include('inc.navbar')
            @yield('marker')
                
        <div class="box" style="height: 600px">
                <img src="https://seke.se/images/logos/SEKE.png" alt="Logo" >
                
                <div style="padding-left:16px">
                    <div class="contianer">
                        @yield('headline')
                    </div>
                    @yield('content')
                </div>
            </div>
    </body>
</html>