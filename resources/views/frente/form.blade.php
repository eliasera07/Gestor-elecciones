<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrarFrente</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing:border-box;
            font-family: "Uni Sans" , sans-serif;
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
            display:flex;
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
            font-size:25px;
            color:#fff;
            font-weight: 600;
            text-decoration:none;
        }
        nav .logo a:hover {
            color: #003770;
            transition: 0.5s;
        }
        nav ul {
            display: flex;
            align-items: center;
            justify-content:center;
            gap:2.5rem;
        }
        nav ul li{
            list-style: none;
        }
        nav ul li a{
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }
        nav ul li a:hover{
            color: #003770;
            transition: 0.5s;
        }
        
        .menu-icon{
            display: none;
            width: 25px;
            height:3px;
            background: #fff;
            transform: translateY(-50%);
            transition: 0.5s;
            border-radius:5px;
            cursor: pointer;
        }
        .menu-icon::before,
        .menu-icon::after{
            content:"";
            position: absolute;
            width: 25px;
            height:3px;
            background: #fff;
            transition:0.5s;
            border-radius: 5px;
        }
        .menu-icon::before{
            top:-8px;
        }
        .menu-icon::after{
            top:-8px;
        }
        .menu-icon.active{
            background: rgba(0,0,0,0);
        }
        .menu-icon.active::before{
            top:0;
            transform:rotate(45deg);
        }
        .menu-icon.active::after{
            top:0;
            transform: rotate(135deg);
        }
        @media screen and (max-width:992px){
            nav ul{
                position:fixed;
                top: 0px;
                right:100%;
                width:100%;
                height: 90vh;
                background: #004a92;
                flex-direction: column;
                transition: 0.5s ease-in;
            }
            nav ul li a{
                font-size: 24px;
            }
            ul.active{
                right: 0;
                transition: 0.5s ease-in;
            }
            .menu-icon{
                display: block;
            }
        }
        
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
            padding: 2px 0;
        }
        
        .votante-form-container {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }

        .votante-form-container .form-title {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .votante-columns {
            display: flex;
            justify-content: space-between;
        }

        .votante-column {
            flex: 1;
            padding: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
       
        select {
        width: 92%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        
        input[type="submit"]{
            background-color: #04243C;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;    
        }
        input[type="reset"]{
            background-color: #A70606;
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

    .error-message {
    color: red;
    font-size: 12px;
    margin-top: -10px; 
    display: block;
}
    </style>


</head>
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
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contactos</a></li> --}}
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <div class="header">
            <label for=""></label><br><br>
           
            </div>
    <div class="votante-form-container">
    <form action="{{ url('/frente') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($frente))
                {{ method_field('PATCH') }}
            @endif

        <h2 class="form-title">Registrar Frente</h2>
        <div class="column">

        <label for="ideleccionfrente">Elegir Elección:</label>
              <select name="ideleccionfrente" id="ideleccionfrente" required>
              <option value="">Selecciona una elección</option>
              @if (isset($elecciones))
              @foreach ($elecciones as $eleccion)
                   <option value="{{ $eleccion->id }}" @if(isset($frente) && $frente->ideleccion == $eleccion->id) selected @endif>{{ $eleccion->nombre }}</option>
              @endforeach
              @endif
             </select>
                @error('ideleccionfrente')
                   <span class="error-message">{{ $message }}</span>
                @enderror

                <label for="nombrefrente">Nombre del frente:</label>
<input type="text" placeholder="Escribe el nombre del frente aquí..." maxlength="40" oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
       name="nombrefrente" value="{{ isset($frente) ? $frente->nombrefrente : old('nombrefrente') }}" required>
@error('nombrefrente')
<span class="error-message">{{ $message }}</span>
@enderror<br><br>

                <label for="cargopostulacion">Cargo de postulacion:</label>
                <input type="text" placeholder="Escribe el cargo de postulacion aqui..." maxlength="40"
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                 name="cargopostulacion" value="{{ isset($frente) ? $frente->cargopostulacion : '' }}" id="cargopostulacion" required><br><br>
        
        
        
        
                <label for="fotofrente">Logo del Frente:</label>
                    @if (isset($frente) && $frente->fotofrente)
                        <p>{{ $frente->fotofrente }}</p>
                    @endif
                    <input type="file" title="Subir Logotipo o foto del frente" name="fotofrente" required
                    accept=".png, .jpg, .jpeg"   
                    {{ isset($frente) && $frente->fotofrente ? '' : '' }}><br><br>
                
                <label for="">Cantidad de Candidatos:</label>
                <select name="" id="cantCandidatos" required>
                    <option value="candidato1">1</option>
                    <option value="candidato2">2</option>
                    <option value="candidato3">3</option>
                    <option value="candidato4">4</option>
                </select>    
                <div class="campo-adicional" id="candidato1">
                <label for="profesion">Nombre Candidato de Frente 1:</label>
                <input type="text" placeholder="Escribe el Cnombre aquí..." maxlength="30"
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="nombrecandidato1" value="{{ isset($frente) ? $frente->nombrecandidato1 : old('nombrecandidato1') }}" id="codSis" required>
                </div>
                <div class="campo-adicional" id="candidato2">
                <label for="profesion">Nombre Candidato de Frente 2:</label>
                <input type="text" placeholder="Escribe el Cnombre aquí..." maxlength="30"
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="nombrecandidato2" value="{{ isset($frente) ? $frente->nombrecandidato1 : old('nombrecandidato2') }}" id="codSis" >
                </div>
                <div class="campo-adicional" id="candidato3">
                <label for="profesion">Nombre Candidato de Frente 3:</label>
                <input type="text" placeholder="Escribe el Cnombre aquí..." maxlength="30"
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="nombrecandidato3" value="{{ isset($frente) ? $frente->nombrecandidato3 : old('nombrecandidato1') }}" id="codSis" >
                </div>
                <div class="campo-adicional" id="candidato4">
                <label for="profesion">Nombre Candidato de Frente 4:</label>
                <input type="text" placeholder="Escribe el Cnombre aquí..." maxlength="30"
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="nombrecandidato4" value="{{ isset($frente) ? $frente->nombrecandidato4 : old('nombrecandidato1') }}" id="codSis" >
                </div>



                
                @error('nombrecandidato1')
                <span class="error-message">{{ $message }}</span>
                @enderror<br><br>

                
        
        </div>

        <input type="submit" value="Registrar"
                onclick="confirmacion()">
          
        <input type="reset" value="Cancelar" onclick="cancelacion()">
        <label for=""></label><br><br>
        <label for=""></label><br><br>
        
    </form>
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
    
    <script>
        function cancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/elecciones";
            }
        }

        function confirmacion() {
            var confirmacion = confirm("Estas seguro de registrar este frente?");
            if (confirmacion) {

                window.location.href = "/frente";
            }
        }

    </script>
    <script>
        function mostrarCampoAdicional() {
            var cantCandidatos = document.getElementById("cantCandidatos").value;
            var candidato1 = document.getElementById("candidato1");
            var candidato2 = document.getElementById("candidato2");
            var candidato3 = document.getElementById("candidato3");
            var candidato4 = document.getElementById("candidato4")
            
            candidato1.style.display = "none";
            candidato2.style.display = "none";
            candidato3.style.display = "none";
            candidato4.style.display = "none";
            
            if (cantCandidatos === "candidato1") {
                candidato1.style.display = "block";
            } else if (cantCandidatos === "candidato2") {
                candidato1.style.display = "block";
                candidato2.style.display = "block";
            } else if (cantCandidatos === "candidato3") {
                candidato1.style.display = "block";
                candidato2.style.display = "block";
                candidato3.style.display = "block";
            } else if(cantCandidatos === "candidato4") {
                candidato1.style.display = "block";
                candidato2.style.display = "block";
                candidato3.style.display = "block";
                candidato4.style.display = "block";
            } else{
                candidato1.style.display = "block";
                candidato2.style.display = "block";
                candidato3.style.display = "block";
                candidato4.style.display = "block";
            }

        }

        document.getElementById("cantCandidatos").addEventListener("change", mostrarCampoAdicional);

        mostrarCampoAdicional();
    </script>



</div>
    
</body>
</html> 