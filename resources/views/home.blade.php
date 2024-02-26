@extends('layouts.header_footer')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        .title h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .title p {
            font-size: 16px;
        }

        .title {
            padding-left: 20px;
        }

        .fondo {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, #003770, #f80211);
            color: white;
        }

        .contenedor {
            display: flex;
            justify-content: center; 
            align-items: center;
            height: 100vh; 
            flex-wrap: wrap; 
        }

        .columna {
            width: 50%;
            box-sizing: border-box;
            padding: 5px;
        }

        .carrusel {
            margin-left: 15%;
            margin-right: 15%;
        }

        .pdf-box {
            background: rgba(255, 255, 255, 0.1); 
        }

        .pdf-box embed {
            transform: scale(0.9); 
            overflow: hidden;
            transform-origin: center; 
        }
        .pdf-overlay {
            position: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.2); 
            padding: 5px;
        }

        .pdf-overlay h2{
            margin-bottom: 20px;
            color:white;
        }

        .pdf-overlay p{
            color:white;
        }
        .comunicado a {
            text-decoration: none; 
        }

        @media (max-width: 768px) {
            .contenedor {
                flex-direction: column; 
            }

            .columna {
                width: 100%; 
                margin: 5%; 
                padding: 0; 
            }
            
        }

        /*.content-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }
        .carrusel {
            /*display: flex;
            justify-content: center; 
            align-items: center;
            overflow-x: auto; 
            white-space: nowrap; 
            width: 100%; 

            margin-top: 30%;
            margin-left: 20%;
            margin-right: 20%;

        }

        /*.comunicado {
            position: relative;
            margin-bottom: 20px; 
            display: flex;
            flex-direction: column;
            align-items: center; 
        }

        .pdf-box {
            /*width: relative;
            height: relative;
            overflow: hidden; 
            position: relative;
            z-index: -1;
            background: rgba(255, 255, 255, 0.7); 
        }

        .pdf-box embed {
            transform: scale(1); 
            overflow: hidden;
            transform-origin: center; 
            /*width: 100%; 
            height: 100%; 
            
            overflow: hidden; 
        }
        .pdf-overlay {
            position: center;
            /*bottom: 0;
            left: 0;
            text-align: center;
            background: rgba(255, 255, 255, 0.9); 
            padding: 5px;
        }*/
    </style>
</head>

<body class="fondo">
    <div class="contenedor">
        <div class="columna">
            <div class="content-container">
                <div class="title">
                    <h1>Tribunal Electoral Universitario</h1>
                    <p>El TEU es responsable de las elecciones democráticas dentro de la Universidad Mayor de San Simón.</p>
                </div>
            </div>
        </div>

        <div class="columna">
            <div class="carrusel">
                

            
            </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Inicializa el carrusel -->
    <script>
        $(document).ready(function(){
            // Selecciona la clase .carrusel dentro de la segunda columna y aplica Slick Carousel
            $('.carrusel').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
        });
        })

    </script>
</body>

</html>
