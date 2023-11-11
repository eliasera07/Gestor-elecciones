<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear/Editar una elección</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>

<style>
    /* Estilos del encabezado */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Uni Sans", sans-serif;
    }

    .company-logo {
        border-radius: 8%;
        max-width: 15%;
        height: auto;
        float: left;
        margin-right: 40px;
    }

    nav {
        display: flex;
        align-items: center;
        justify-content: space-around;
        height: 70px;
        background-image: linear-gradient(to right, #003770, #f80211);
        border-bottom: 2px solid #fff;
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

    /* Estilos del contenido */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .header {
        background-color: white;
        color: white;
        text-align: center;
        padding: 20px 0;
    }

    .container {
        max-width: 1300px;
     
        margin: 2px auto;
        background-color: #fff;
        padding: 8px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

     






    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    .form-title {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="file"] {
        margin-top: 5px;
    }

    input[type="submit"],
    input[type="reset"] {
        background-color: #04243C;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #0056b3;
    }

    /* Estilos para las columnas */
    .columns {
        display: flex;
        justify-content: space-between;
    }

    .column {
        flex: 1;
        padding: 10px;
    }

    .footer {
        background-color: #003770;
        color: white;
        padding: 15px;
        position: fixed;
        bottom: 0;
        right: 0;
        left: 0;
        font-size: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-izq {
        flex: 1;
        text-align: left;
        margin-left: 70px;
    }

    .footer-medio {
        text-align: center;
        flex: 1;
    }

    .footer-der {
        flex: 1;
        text-align: center;
    }

    .footer-der a {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
        font-size: 18px;
    }

    .footer-der a:hover {
        color: red;
        font-size: 20px;
    }

    .boton1,
    .boton {
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        border: 1px solid rgba(198, 69, 196, 0.3);
        padding: 10px 20px;
        background-color: #75D731;
        color: rgba(4, 36, 60, 0.99);
        font-size: 16px;
        cursor: pointer;
    }

    .form-title1,
    .form-title {
        color: rgba(4, 36, 60, 0.99);
        font-size: 25px;
        text-align: left;
        font-weight: 400;
        margin-left: 30px;
    }

    .acomodar {
        display: flex;
        justify-content: space-between;
    }

    .column1,
    .column2 {
        text-align: left;
    }

    .column2 {
        text-align: right;
        margin-right: 40px;
        margin-top: 15px;
    }

    .pdf-box {
        width: 100px;
        height: 100px;
        overflow: hidden;
        position: relative;
        z-index: -1;
    }

    .pdf-box embed {
        width: 100%;
        height: 100%;
        transform: scale(0.7);
        transform-origin: center;
        overflow: hidden;
    }
</style>

<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo2">
                <img src="/images/Logo_TE.png" alt="Logo de Enrique" class="company-logo">
            </a>
            <div><a href="{{ url('/') }}">TRIBUNAL ELECTORAL</a></div>
            <div><a href="{{ url('/') }}">UNIVERSITARIO</a></div>
        </div>
        <ul>
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="{{ url('/comunicados') }}">Comunicados</a></li>
            <li><a href="#">Documentación</a></li>
            <li><a href="#">Ingreso</a></li>
            <img src="/images/img.png" class="company-logo">
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <header></header>
    <div class="header">
        <label for=""></label><br><br>
    </div>

    <div class="acomodar">
        <div class="column1">
            <h2 class="form-title1"> Eleccion Rector 2023</h2>
            <h2 class="form-title"> Nº de Votantes:</h2>
        </div>
        <div class="column2">
            <input type="submit" class="boton1" value="{{ isset($elecciones) ? 'Actualizar' : 'Registrar resultados' }}"
                onclick="confirmarConfirmacion()">
            <input type="submit" class="boton" value="{{ isset($elecciones) ? 'Actualizar' : 'Editar resultados' }}"
                onclick="confirmarConfirmacion()">
        </div>
    </div>

    <div class="container">
        <form action="{{ isset($elecciones) ? url('/elecciones/' . $elecciones->id) : url('/elecciones') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($elecciones))
                {{ method_field('PATCH') }}
            @endif

            <div class="columns">
                <div class="column">
                <h2 class="forms" style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;">Motivo de eleccion:</h2>

                <label for="nom" > Motivo de eleccion:</label>
                    <br><br>
                    <h2 class="forms"style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;"> Cargo de Autoridad:</h2>
                    <label for="nombre"> Cargo de Autoridad:</label>
                    <br><br>
                    <h2 class="forms"style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;"> Gestion:</h2>
                    <label for="nom"> Gestion:</label>
                    <br><br>
                    <h2 class="forms"style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;"> Tipo de Votantes:</h2>
                    <label for="nom"> Tipo de Votantes:</label>
                    <br><br>
                    <h2 class="forms" style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;"> Fecha de inscripcion de frentes:</h2>
                    <label for="nom"> Fecha de inscripcion de frentes:</label>
                    <br><br>
                    <h2 class="forms"style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;">Fecha de eleccion:</h2>
                    <label for="nom"> Fecha de eleccion:</label>
                </div>

                <div class="column">
                <h2 class="forms"style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;">Convocatoria (PDF):</h2>

                    <br><br>
                    <br><br>
                    <br><br>
                    <br><br>
                    
                    <h2 class="forms" style="color: rgba(4, 36, 60, 0.99); font-size: 20px;  font-weight: 400; word-wrap: break-word;" >Tipo de Eleccion:</h2>
                    <label for="nom"> Tipo de Eleccion:</label>
                </div>
            </div>
        </form>

        <div class="footer">
            <div class="footer-izq">
                Av. Oquendo y calle Jordán asd
                <br> Mail: Tribunal_electoral@umss.edu
                <br> www.umss.edu.bo Cochabamba - Bolivia
                <br> Design: DevGenius
            </div>
            <div class="footer-medio">
                Copyright © 2023 Tribunal Electoral Universitario Todos los derechos Reservados
            </div>
            <div class="footer-der">
                <a href="{{ url('/') }}">Acerca de</a>
                <span>&nbsp;|&nbsp;</span>
                <a href="{{ url('/') }}">Contactos</a>
            </div>
        </div>
    </div>
</body>

</html>
