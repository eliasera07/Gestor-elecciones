<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Uni Sans", sans-serif;
        }

        .company-logo {
            border-radius: 8%;

            max-width: 15%;
            /* Ajusta el ancho máximo de la imagen al 100% del contenedor */
            height: auto;
            /* Permite que la altura se ajuste automáticamente para mantener la proporción */
            /* Alinea verticalmente la imagen en el medio del texto */
            float: left;
            margin-right: 40px;

        }

        nav {

            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 70px;
            background-image: linear-gradient(to right, #003770, #f80211);
            /* Linea que separa el header con el body */
            /* border-bottom: 1px solid #ffffff; */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        nav .logo a {
            font-size: 25px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }

        nav .logo a:hover {
            color: #003770;
            transition: 0.5s;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2.5rem;
        }

        nav ul li {
            list-style: none;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        nav ul li a:hover {
            color: #003770;
            transition: 0.5s;
        }

        .menu-icon {
            display: none;
            width: 25px;
            height: 3px;
            background: #fff;
            transform: translateY(-50%);
            transition: 0.5s;
            border-radius: 5px;
            cursor: pointer;
        }

        .menu-icon::before,
        .menu-icon::after {
            content: "";
            position: absolute;
            width: 25px;
            height: 3px;
            background: #fff;
            transition: 0.5s;
            border-radius: 5px;
        }

        .menu-icon::before {
            top: -8px;
        }

        .menu-icon::after {
            top: -8px;
        }

        .menu-icon.active {
            background: rgba(0, 0, 0, 0);
        }

        .menu-icon.active::before {
            top: 0;
            transform: rotate(45deg);
        }

        .menu-icon.active::after {
            top: 0;
            transform: rotate(135deg);
        }


        @media screen and (max-width: 992px) {
            nav ul {
                position: fixed;
                top: 0px;
                right: 100%;
                width: 100%;
                height: 90vh;
                background: #004a92;
                flex-direction: column;
                transition: 0.5s ease-in;
            }

            nav ul li a {
                font-size: 24px;
            }

            ul.active {
                right: 0;
                transition: 0.5s ease-in;
            }

            .menu-icon {
                display: block;
            }
        }

<<<<<<< HEAD
        .footer {
            background-color: #003770;
            color: white;
=======

        body {

            font-family: Arial, sans-serif;
            background: radial-gradient(circle at 50% 50%, #C20000, #003770), repeating-radial-gradient(circle, transparent 0, transparent 5px, #333 5px, #333 10px);

            margin: 0;
            padding: 0;
            color: white;
            position: relative;
            overflow: hidden;
        }





        .footer {
            background-color: #003770;
            /*background-image: linear-gradient(to right, #003770, #C20000);*/
            color: white;
            text-align: right;
>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
            padding: 15px;
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            font-size: 15px;
            display: flex;
<<<<<<< HEAD
            justify-content: space-between;
            align-items: center;
        }

        .footer-izq {
            flex: 1;

            text-align: left;
            margin-left: 70px;
            /* Ajusta el valor de margen según cuánto espacio desees agregar */
        }

        .footer-medio {
            text-align: center;
            display: flex;
            align-items: center;
            white-space: nowrap;
            /* Evita el retorno de línea */
            overflow: hidden;
            /* Oculta el desbordamiento si el contenido es demasiado largo */
            text-overflow: ellipsis;
            /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
            display: flex;
            align-items: center;
            white-space: nowrap;
            /* Evita el retorno de línea */
            overflow: hidden;
            /* Oculta el desbordamiento si el contenido es demasiado largo */
            text-overflow: ellipsis;
            /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
            font-size: 18px;

        }

        .footer-der {
            flex: 1;
            text-align: center;
        }

        .footer-der a {
            color: white;
            /* Establece el color del texto en blanco por defecto */
            text-decoration: none;
            /* Elimina el subrayado predeterminado de los enlaces */
            transition: color 0.3s;
            /* Agrega una transición suave para el cambio de color */
            font-size: 18px;
            /* Ajusta el tamaño de fuente según tus preferencias */

        }

        .footer-der a:hover {
            color: red;
            /* Cambia el color del texto a rojo al pasar el ratón sobre el enlace */
            font-size: 20px;
            /* Tamaño de fuente al pasar el ratón sobre el enlace, puedes ajustarlo según tus preferencias */

        }

        .fondoooo {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right, #003770, #f80211);
            /*background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 55, 112, 0.4) 10px, rgba(0, 55, 112, 0.4) 20px);*/
            /*background: linear-gradient(to bottom, #003770, #C20000);*/
            /*background: repeating-linear-gradient(60deg, #003770 0px, #003770 10px, #C20000 10px, #C20000 20px);*/
            /*background: radial-gradient(circle at 50% 50%, #C20000,#003770), repeating-radial-gradient(circle, transparent 0, transparent 5px, #333 5px, #333 10px);*/

            color: white;
=======
            flex-direction: column;
            align-items: flex-end;
        }

        .footer .second-line {
            font-size: 14px;
>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
        }

        .content-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;

        }

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
<<<<<<< HEAD

        

        .comunicado-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Alinea los elementos a la derecha de la pantalla */
        }

        .comunicado {
            position: relative;
            margin-bottom: 20px; /* Espacio entre comunicados */
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra los elementos horizontalmente */
        }
        .comunicado {
            position: relative;
            margin-bottom: 20px; /* Espacio entre comunicados */
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra los elementos horizontalmente */
        }

        .pdf-box {
            width: 200px;
            height: 200px;
            overflow: hidden; /* Recorta cualquier contenido que se desborde del cuadro */
            position: relative;
            z-index: -1;
        }

        .pdf-box embed {
            width: 100%; /* Ancho del embed es igual al 100% del contenedor */
            height: 100%; /* Altura del embed es igual al 100% del contenedor */
            transform: scale(0.7); /* Escala el PDF para que quepa dentro del cuadro */
            transform-origin: center; /* Define el punto de origen de la escala al centro */
            overflow: hidden; /* Oculta barras de desplazamiento del PDF */
        }

        .pdf-overlay {
            width: 100%; /* Utiliza el 100% del ancho del contenedor principal */
            text-align: center;
            background: rgba(255, 255, 255, 0.7); /* Fondo semi-transparente para mejorar la legibilidad del texto */
        }
    </style>

=======
    </style>
>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
</head>

<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo2">
<<<<<<< HEAD
                <img src="/images/Logo_TE.png" alt="Logo de Enrique" class="company-logo">

=======
                <img src="/images/LogoUMSS2.png" alt="Logo de la Empresa" class="company-logo">
>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
            </a>
            <div><a href="{{ url('/') }}">TRIBUNAL ELECTORAL</a></div>
            <div><a href="{{ url('/') }}">UNIVERSITARIO</a></div>
        </div>
        <ul>
<<<<<<< HEAD
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>

            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="#">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li> --}}
=======
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="#">Documentación</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li>
>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>
<<<<<<< HEAD

    <section class="fondoooo">
        <div class="content-container">
            <div class="title">
                <h1>Tribunal Electoral Universitario</h1>
                <p>El TEU es responsable de las elecciones democráticas dentro de la Universidad Mayor de San Simón.</p>
            </div>
        </div>
        <div class="carrusel">
            @foreach($comunicados as $comunicado)
                <div class="comunicado">
                    <a href="{{ asset('storage/' . $comunicado->pdf) }}" target="_blank">
                    <div class="pdf-overlay">
                        <h2>{{ $comunicado->titulo }}</h2>
                        <p>{{ $comunicado->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="pdf-box">
                        <embed src="{{ asset('storage/' . $comunicado->pdf) }}" type="application/pdf" width="100%" height="100%">
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <div class="footer">

        <div class="footer-izq">
            Av. Oquendo y calle Jordán asd
            <br>
            Mail: Tribunal_electoral@umss.edu
            <br>
            www.umss.edu.bo Cochabamba - Bolivia
            <br>
            Design: DevGenius

        </div>
        <div class="footer-medio">

            Copyright © 2023 Tribunal Electoral Universitario Todos los derechos Reservados

        </div>
        <div class="footer-der">
            <a href="{{ url('/') }}">Acerca de</a>
            <span>&nbsp;|&nbsp;</span> <!-- Para agregar un separador -->
            <a href="{{ url('/') }}">Contactos</a>

        </div>

    </div>
</body>
=======
    <!-- Header personalizado -->
    <div class="content-container">
        <div class="title">
            <h1>Tribunal Electoral Universitario</h1>
            <p>El TEU es responsable de las elecciones democráticas dentro de la Universidad Mayor de San Simón.</p>
        </div>
    </div>

    <div class="footer">
    <span>
            Av. Oquendo y calle Jordán 
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
            Copyright © 2023 Tribunal Electoral Universitario<br> 
            
            Mail: Tribunal_electoral@umss.edu 
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
            Todos los derechos Reservados<br>
        
            www.umss.edu.bo Cochabamba - Bolivia
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
            &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
            Design: DevGenius </span>
    </div>
</body>

>>>>>>> registro-frentes+correcciones-en-mensajes-de-error
</html>
