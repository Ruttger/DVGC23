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

        <!-- Forum style, will move to css -->
        <style>


            table {
                border-radius: 20px 20px 0px 0px;
                min-width: 100%;    
                width: 100%; 
                margin-bottom: 3%;
            } 

            .category_forum td:nth-child(1){
                width: 71%;
                text-align: left; 
            }
            .category_forum td:nth-child(2){
                width: 7%;
                text-align: left;
            }
            .category_forum td:nth-child(3){
                width: 7%;
                text-align: left;
            } 
            .category_forum td:nth-child(4), th:nth-child(4){
                width: 15%;
                text-align: left;
            }

            .category_forum a {
                text-decoration: none;
                color: black;
            } 
      
            .category_forum th {
                background-color: #E1EBF2; 
                text-align: left;
                padding: 10px;


                /* fix overflow */
                min-width: 40%;
                max-width: 40%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;                
            }

            .category_forum td {       
                padding: 10px;
            
                /* fix overflow */
                max-width: 100px;
                vertical-align: top;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                
            } 
      
            .category_forum tr {
                height: 100px; 
                background-color: #ECF3F7; 
            }

            .category_forum tr:nth-child(odd) { 
                background-color: #ECF3F7; 
            }
            
            .category_forum tr:nth-child(even) { 
                background-color: #E1EBF2; 
            }

            .category_forum h3, h5 {
                padding: 0px;
                margin: 0px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }



            .threads table {
                table-layout: fixed;
                border-radius: 20px 20px 0px 0px;
                min-width: 100%;    
                width: 100%; 
                margin-bottom: 3%;
                
            }            


            .threads tr {
                
            }

            .threads tr:first-child { 
                background-color: #ECF3F7;
            }
            
            .threads tr {
                height: 150px; 
                background-color: #E1EBF2;
            }

            .threads td {
                max-width: 100px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .threads td:nth-child(1){
                min-width: 80%;
                width: 80%;
                padding-left: 1%;
                padding-top: 0.5%;
                margin-top: 0%;
                vertical-align: top;
                word-wrap:break-word;
            } 

            .threads td:nth-child(2){
                min-width: 20%;
                width: 20%;
                padding-left: 1%;
                padding-right: 1%;
                padding-top: 0.5%;
                vertical-align: top;
                word-wrap:break-word;
            }


        </style>
    </head>
        <body class="" style="background-color:#969696;">
            @include('inc.navbar')
            @yield('marker')
                
        <div class="box" style="min-height: 100vh; height: auto">
                <img src="https://seke.se/images/logos/SEKE.png" alt="Logo" >
                
                <div style="padding-left:16px; padding-right:16px">
                    <div class="contianer">
                        @yield('headline')
                    </div>
                    @yield('content')
                </div>
            </div>
    </body>
</html>