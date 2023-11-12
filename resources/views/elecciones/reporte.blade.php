<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
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

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: white;
    }

    .header {
        background-color: white;
        color: white;
        text-align: center;
        padding: 20px 0;
    }

    h1 {
        color: rgba(4, 36, 60, 0.99);
        font-size: 25px;
        text-align: left;
        font-weight: 400;
    }
    .titulo h1 {
        margin-right: 1000px;
    }

    .contenedor {
        max-width: 1300px;
        margin: 25px ;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column; 
        align-items: center; 
        height: 600px; 
    }
    .entradas{
        max-width: 1000px;
        display: flex;
        justify-content: space-between;
    }
    
    .input-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    
    label {
        margin-top: 5px;
        padding-top:10px;
        font-weight: bold;
        font-size: 18px;
        color: #555;
        margin-left: 10px
    }
    select {
        width: 300px;
        padding: 10px;
        margin-left: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }
    input[type="date"],
    input[type="text"]{
        width: 300px;
        padding: 10px;
        margin-left: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }
    .generar-reporte {
        width: 200px; 
        margin: 20px auto;
        padding: 10px;
        background-color: #003770;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .generar-reporte:hover {
        background-color: #00264d;
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
        <label for=""></label><br>
    </div>
    
    <br>
    <br>
    <form>
           <div class="contenedor">
           <div class="titulo">
                    <h1>Reporte de Elecciones</h1>  
                </div>
                <div class="entradas">
                
                <div class="input-container">
                    <label for="fechaInicio" class="fecIni">Fecha de Inicio:</label>
                    <input type="date" id="fechaInicio" name="fechaInicio" required>
                </div>

                <div class="input-container">
                    <label for="fechaFinal" class="fecFin">Fecha Final:</label>
                    <input type="date" id="fechaFinal" name="fechaFinal" required>
                </div>

                <div class="input-container">
                    <label for="tipoReporte" class="tipRep">Tipo de Reporte:</label>
                        <select name="tipoReporte" id="tipRep" required>
                        <option value="Numero de Votos">Numero de Votos</option>
                        <option value="Numero de Votantes">Numero de Votantes</option>
                        <option value="Reporte de resultados">Reporte de resultados</option>
                    </select>
                </div>        
            </div>      
            <br><br><br>
            <button type="submit" class="generar-reporte">Generar Reporte</button>   
        </div>
       
        
    </form>

</body>
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
</html>
