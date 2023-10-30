{{-- crear/editar mesas --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrarMesa</title>
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
            height: auto;
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
        
        .mesa-form-container {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }

        .mesa-form-container .form-title {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .mesa-columns {
            display: flex;
            justify-content: space-between;
        }

        .mesa-column {
            flex: 1;
            padding: 10px;
        }
        

        /* Estilo para el selector de "Tipo de Votante" */
        #tipoVotante {
            flex: 1; /* Ocupa todo el espacio restante en la línea */
            margin-right: 10px; /* Agrega un margen derecho entre los elementos */
        }   

        /* Estilo para el elemento de "Cantidad" */
        #cantidad {
            font-weight: bold; /* Opcional: Estiliza la fuente en negrita */
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        input[type="number"],
        select {
        width: 95%;
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
            margin-bottom: 10px; 
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
        .centered {
            text-align: center; 
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
            <img src="/images/img.png"  class="company-logo">

        </ul>
        <div class="menu-icon"></div>
    </nav>
    <div class="header">
            <label for=""></label><br><br>
           
            </div>
    <div class="mesa-form-container">
    <form action="{{ url('/mesas') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($mesas))
                {{ method_field('PATCH') }}
            @endif
        <label for=""></label><br><br>
        <h2 class="form-title">Registrar Mesa de Votacion</h2>
        <div class="column">

        <label for="id_de_eleccion">Elección asociada:</label>
<select name="id_de_eleccion" id="id_de_eleccion" required>
    <option value="">Selecciona una elección</option>
    @if (isset($elecciones))
        @foreach ($elecciones as $eleccion)
            <option value="{{ $eleccion->id }}" @if(isset($mesas) && $mesas->ideleccion == $eleccion->id) selected @endif>{{ $eleccion->nombre }}</option>
        @endforeach
    @endif
</select><br><br>

                     
                <label for="votantemesa">Tipo de Votante:</label>
                <select name="votantemesa" value="{{ isset($mesas) ? $mesas->votantemesa : '' }}" id="votantemesa" required>
                    <option value="Estudiante">Estudiante</option>
                    <option value="Docente">Docente</option>
                    <option value="Administrativo">Administrativo</option>
                </select><br><br>

                <div class="campo-adicional" id="facultadmesa">
                <label for="facultadmesa">Facultad de la mesa:</label>
                <input type="text" placeholder="Escribe la fac aquí..." maxlength="40" 
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="facultadmesa" value="{{ isset($mesas) ? $mesas->facultadmesa : '' }}" id="facultadmesa" ><br><br>
                </div>

                <div class="campo-adicional" id="carreramesa">
                <label for="carreramesa">Carrera:</label>
                <input type="text" placeholder="Escribe la Carrera aquí..." maxlength="40" 
                oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                name="carreramesa" value="{{ isset($mesas) ? $mesas->carreramesa : '' }}" id="carreramesa" ><br><br>
                </div>

                <div class="campo-adicional" id="ubicacionmesa">
                <label for="ubicacionmesa">Ubicacion de mesa:</label>
                <input type="text" placeholder="Escribe la ubicacion aquí..." maxlength="40" 
                oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9]+/g, '')"
                name="ubicacionmesa" value="{{ isset($mesas) ? $mesas->ubicacionmesa : '' }}" id="mesas" ><br><br>
                </div>

                <div class="campo-adicional" id="numerodevotantes">
                <label for="numerodevotantes">Numero de votantes:</label>
                <input type="number" placeholder="Escribe el numero de votantes aquí..." maxlength="1000000"
                name="numerodevotantes" value="{{ isset($mesas) ? $mesas->numerodevotantes : '' }}" id="numerodevotantes" ><br><br>
                </div>
                {{--
                <label for=""></label>
                <div class="campo-adicional">
                <label for="numeroMesas">Número de Mesas:</label>
                <div class="input-group">
                    <input type="number" name="numeroMesas" id="numeroMesas" value="1" min="1">
                    
                </div>
                <label for=""></label>--}}
                
                <br><br>      
                
        </div>
        <div class="botones centered">
            <input type="submit" value="{{ isset($mesas) ? 'Actualizar' : 'Crear' }}" onclick="confirmacion()">
            <input type="reset" value="Cancelar" onclick="cancelacion()">
            <label for=""></label><br><br>
            <label for=""></label><br><br>
        </div>


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

                window.location.href = "/mesas";
            }
        }

        function confirmacion() {
            var confirmacion = confirm("Estas seguro de registrar esta mesa?");
            if (confirmacion) {

                window.location.href = "/mesas";    
            }
        }

    </script>



</div>
    <script>
        function mostrarCampoAdicional() {
            var tipoVotante = document.getElementById("tipoVotante").value;
            var campoProfesion = document.getElementById("campoProfesion");
            var campoCargo = document.getElementById("campoCargo");
            var campoCarrera = document.getElementById("campoCarrera")
            
            campoProfesion.style.display = "none";
            campoCargo.style.display = "none";
            campoCarrera.style.display = "none";
            
            if (tipoVotante === "Estudiante") {
                campoCarrera.style.display = "block";
            } else if (tipoVotante === "Docente") {
                campoProfesion.style.display = "block";
            } else if (tipoVotante === "Administrativo") {
                campoCargo.style.display = "block";
            }
        }

        document.getElementById("tipoVotante").addEventListener("change", mostrarCampoAdicional);

        mostrarCampoAdicional();
    </script>
    
</body>
</html> 