<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SEKE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>


    </head>
    <body class="" style="background-color:#969696;">
        <div style="width:auto; height: auto;">
            <div style="position:absolute; left:30%; right:30%; top:15%; bottom:15%; width:40%; height:60%; background-color: #fff; border-radius: 10px 10px 10px 10px; box-shadow: 1px 1px 1px #dbdbdb;"> <!-- Center -->

                <div style="position:top;  padding-left:40%; padding-top:10%;"> <!-- Logo -->
                    <img src="https://seke.se/images/logos/SEKE.png" alt="Logo" width="30%" height="60%">
                </div>
                <div style="position: absolute; left:38%; top:50%;">
                    <form action="user" method="POST">
                    	@csrf
                        <label for="username">Användarnamn:</label><br>
                        <input type="text" id="username" name="username" placeholder="Skriv in användarnamn"><br><br>
                        <label for="password">Lösenord:</label><br>
                        <input type="password" id="password" name="password" placeholder="Skriv in lösenord"><br><br>
                        <button type="submit" style="width:100%;"> Logga in! </button>
                    </form>


                </div>
                <div>
                	@if (\Session::has('error'))
                		{!! \Session::get('error') !!}
                	@endif
                </div>
            </div>
        </div>
    </body>
</html>

