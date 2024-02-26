{{-- mostrar lista de mesas --}}
<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <br>
    <br>
    <br>
    <title>Mesas</title>
    
    
</head>
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
    .container {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 20px auto;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 1000px;
    }
    h2 {
        text-align: center;
        font-size: 20px;
        margin-bottom: 5px; /* Espaciado inferior */
    }
    .table-column {
            flex: 1;
            padding: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }
   
    table,th,td {
        color: #000000;
        border: 2px solid #003770;
    }
   
    th,td {
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #E30613;
        color: white;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    tr:hover {
        background-color: #185a9f;
    }
    
    td:first-child {  
        background-color: #c4babada;
    }

    .boton_descargar {
        display: inline-block;
        width: 50px; 
        height: 50px; 
        text-align: center;
        line-height: 50px;
        border-radius: 3px; 
        font-size: 12px;
        cursor: pointer;
    }
   

    body {
        display: flex;
        flex-direction: column;
        align-items: center; 
    }

    .botImprimir {
        position: fixed;
        top: 50%;
        right: 20px;
    }
    .boton_descargar:hover {
        background-color: #a8a8aa;
    }
   
</style>


    <script>
        function confirmarCancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/jurados/jurados";
            }
        }

        function confirmarConfirmacion() {
            var confirmacion = confirm("Los datos han sido registrados con éxito");
            if (confirmacion) {

                window.location.href = "/jurados/jurados";
            }
        }
    </script>

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
            <li><a href="{{ url('/documentaciones') }}">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li> --}}
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
    <header></header>
    <div class="header">
    <label for=""></label><br><br>
    </div>
    <div class="botImprimir">
        <a href="{{ route('mesas.actapdf', ['id' => $mesa->id]) }}" class="btn btn-success" target="_blank">
        <img src="{{ asset('/images/descargar.png') }}" alt="Botón Descargar PDF" class="boton_descargar" title="Descargar Acta" style="cursor: pointer;">
        </a>
    </div>   

    <div class="container">
        <form action="{{ isset($mesas) ? url('/mesas/' . $mesas->id) : url('/mesas') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($mesas))
                {{ method_field('PATCH') }}
            @endif
    
            <h2>UNIVERSIDAD MAYOR DE SAN SIMÓN - TRIBUNAL ELECTORAL UNIVERSITARIO</h2>

            <h3>Elección a {{ $eleccion->nombre }} </h3>
         
            <h2>ACTA DE APERTURA</h2>
           
            <p>En Cochabamba, a hora {{$horaActual}} del día {{ $fechaFormateada}}, de conformidad con la Convocatoria y el Reglamento Electoral Universitario, se dio inicio al funcionamiento de la mesa {{ $mesa->numeromesa }}.</p>
              
            <div class="container">
                    <table id="actasTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>Tipo de Jurado</th>
                                <th>Nombre</th>
                                <th>Firma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurados as $jurado)
                                <tr>
                                    <td>{{ $jurado->tipojurado }}</td>
                                    <td>{{ "$jurado->nombre $jurado->apellidoPaterno $jurado->apellidoMaterno" }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
            </div>

            <h2>ACTA DE CIERRE</h2>
        
            <p>Transcurrida la votación continua se procedió al cierre de la mesa {{ $mesa->numeromesa }} efectuándose inmediatamente el escrutinio de votos, con los siguientes resultados:</p>

        <!-- Add your content for results here -->

            <div class="container">
                <table id="actasTable" class="vistatabla">
                    <thead>
                        <tr>
                            <th>Frente</th>
                            <th>Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frentes as $frente)
                            <tr>
                                <td>{{ $frente->nombrefrente }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <h3>Votos validos:</h3>
                <h3>Votos blancos:</h3>
                <h3>Votos nulos:</h3>
                <h3>Total de votos emitidos:</h3>
            
            <div class="container">    
                <p>Con lo que concluyó el acto en conformidad suscribimos nuestras firmas:</p>    
                <table id="actasTable" class="vistatabla">
                    <thead>
                        <tr>
                            <th>Tipo de Jurado</th>
                            <th>Nombre</th>
                            <th>Firma</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frentes as $frente)
                            <tr>
                                <td>Delegado de frente {{$frente->nombrefrente}}</td>
                                <td>{{ $frente->nombrecandidato1 }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        @foreach ($jurados as $jurado)
                            <tr>
                                <td>{{ $jurado->tipojurado }}</td>
                                <td>{{ "$jurado->nombre $jurado->apellidoPaterno $jurado->apellidoMaterno" }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3>Observaciones: 
                    <p>______________________________________________________________________________________</p>
                    <p>______________________________________________________________________________________</p>
                    <p>______________________________________________________________________________________</p>
                </h3>
                
            </div>
    
        </form>
    </div>
    <br><br>
    <br><br>
    <br><br>
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
            <a href="{{ url('/acercade') }}">Acerca de | Contactos</a>
            <!--<span>&nbsp;|&nbsp;</span> 
            <a href="#">Contactos</a>-->

            </div>

        </div>


</body>

</html>