<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Resultados</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    


    <script>
        function confirmarCancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/elecciones";
            }
        }

        function confirmarConfirmacion() {
            var confirmacion = confirm("Estas seguro de registrar estos resultados?");
            if (confirmacion) {

                window.location.href = "/elecciones";
            }
        }
    </script>
  
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

@media screen and (max-width:992px) {
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

.container {
    max-width: 1300px;
    margin-right: 20px ;
    margin-left: 20px ;
    background-color: white;
        background-color: white;

    padding: 20px;
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

.form-title1{
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

input[type="submit"] {
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        border: 1px solid rgba(198, 69, 196, 0.3);
        padding: 10px 20px;
        background-color: #003770;
        color: #fff;
        font-size: 16px;
        cursor: pointer;




}

input[type="reset"] {
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        border: 1px solid rgba(198, 69, 196, 0.3);
        padding: 10px 20px;
        background-color: #f80211;
        color: #fff;
        font-size: 16px;
        cursor: pointer;

}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color:  #04243C;
}

/* Estilos para las columnas */
.columns {
    display: flex;
    justify-content: space-between;
    margin-left :100px;
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
    .botones{
        text-align:right;
        margin-right:30px;

    }
    .form-title {
        color: rgba(4, 36, 60, 0.99);
        font-size: 30px;
        text-align: left;
        font-weight: 400;
        margin-left: 30px;
    }
    .form-title1{
        color: rgba(4, 36, 60, 0.99);    
    font-size: 28px;
    margin-bottom: 20px;
    text-align: center;
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
            <li><a href="{{ url('/documentaciones') }}">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contactos</a></li> --}}
            <li>
    @if(auth()->check())
        {{-- Si el usuario ha iniciado sesión, mostrar el enlace de Cerrar Sesión --}}
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        {{-- Si el usuario no ha iniciado sesión, mostrar el enlace de Ingreso --}}
        <a href="{{ url('/iniciarsesion') }}">Ingreso</a>
    @endif
</li>
            <img src="/images/img.png"  class="company-logo">
        </ul>
        <div class="menu-icon"></div>
    </nav>


    <div class="header">
        <label for=""></label><br><br>
    </div>
  
    <br>
   
    <div class="container">
        <form action="{{ url('/elecciones/' . $eleccion->id . '/guardarResultados') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}

            <div class="column1">
                <h2 class="form-title"> {{ $eleccion->nombre }} </h2>
            </div>
            <h2 class="form-title1">Editar resultados</h2>
            <br><br>

            <div class="columns">
           @php
              $numFrentes = 4; // 
              $halfCount = ceil($numFrentes / 2);
           @endphp


           <div class="column">
            
             <label for="votosblancoselec">Votos en Blanco:</label><br>
           <input type="number" name="votosblancoselec" id="votosblancoselec" value="{{ $eleccion->votosblancoselec }}" style="width: 200px;" required><br><br>

             <label for="votosnuloselec">Votos Nulos:</label><br>
             <input type="number" name="votosnuloselec" id="votosnuloselec" value="{{ $eleccion->votosnuloselec }}" style="width: 200px;" required><br><br>
                    
                
            </div>

             <div class="column">
               @for ($index = 1; $index <= $halfCount; $index++)
                 @if (!empty($eleccion->{'nombrefrente' . $index}))
                <label for="nombrefrente{{ $index }}">Nombre frente {{ $index }}:</label><br>
                <input type="text" name="nombrefrente{{ $index }}" value="{{ $eleccion->{'nombrefrente' . $index} }}" maxlength="100" style="width: 200px;" readonly required><br><br>

                <label for="votosfrente{{ $index }}">Nº de votos frente {{ $index }}:</label><br>
                <input type="number" name="votosfrente{{ $index }}" value="{{ $eleccion->{'votosfrente' . $index} }}" style="width: 200px;" required><br><br>
                 @endif
              @endfor
             </div>

              <div class="column">
                @for ($index = $halfCount + 1; $index <= $numFrentes; $index++)
                    @if (!empty($eleccion->{'nombrefrente' . $index}))
                <label for="nombrefrente{{ $index }}">Nombre frente {{ $index }}:</label><br>
                <input type="text" name="nombrefrente{{ $index }}" value="{{ $eleccion->{'nombrefrente' . $index} }}" maxlength="100" style="width: 200px;" readonly required><br><br>

                <label for="votosfrente{{ $index }}">Nº de votos frente {{ $index }}:</label><br>
                <input type="number" name="votosfrente{{ $index }}" value="{{ $eleccion->{'votosfrente' . $index} }}" style="width: 200px;" required><br><br>
                    @endif
                 @endfor
              </div>
             </div>

             


            <div class="botones">
                <input type="submit" value="{{ 'Actualizar' }}" onclick="return confirm ('¿Está seguro que registrar estos resultados?')">
                <input type="reset" value="Cancelar" onclick="confirmarCancelacion()">
            </div>
            <label for=""></label><br><br>
            <label for=""></label><br><br>
            <br><br>
            <br><br>

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
            <div class="footer-der">
            <a href="{{ url('/acercade') }}">Acerca de | Contactos</a>
            <!--<span>&nbsp;|&nbsp;</span> 
            <a href="#">Contactos</a>-->

            </div>

        </div>
    </div>
</body>

</html>