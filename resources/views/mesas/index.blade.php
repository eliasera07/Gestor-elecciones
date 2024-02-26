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
    <title>Lista de Mesas</title>
    
    
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

    max-width: 1400px;
    margin: 0 auto;
    
    
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


.botonesss {
    max-width: max-content;
    /* Ajusta el ancho del contenedor según tus necesidades */
    

}

/* CSS para todos los botones */
.botones {

    display: inline-block;
    margin-right: 10px;
}
 /* Botones dentro de la tabla */
    .buttons-dentro-tabla {
        /* background-color: #04243C; */
        color: #FFF;
        padding: 1px 3px;
        border: none;
        cursor: pointer;
        border-radius: 15%;
        display: inline-block; /* Esto hará que los botones estén en línea horizontal */
        margin-right: 10px; 
    }
    
    /* Estilos para la imagen dentro del botón */
    .formato-imagen {
        width: 30px; /* Ajusta el ancho según tus necesidades */
        height: 30px; /* Ajusta la altura según tus necesidades */
        display: block;
        margin: 0 auto;
    }
    
    /* Estilos para centrar verticalmente el contenido en la celda de la tabla */
    .celda-botones {
        text-align: center;
    }
/* Hasta aca son los botones dentro de la tabla */

.buttons {
    padding: 10px 20px;
    background: #003770;
    font-size: 14px;
    font-weight: bold;
    /* Tipo de letra */
    font-family: 'Open Sans', sans-serif;
    position: relative;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;

    /* Transición suave del color de fondo del botón al pasar el mouse sobre él */

}

.buttons:hover {
    background-color: #E30613;
    /* Cambia el color de fondo del botón al pasar el mouse sobre él */
}

.buttons:active {
    background-color: #8b010a;  
}

table {
    width: 100%;
    /* Ancho de la tabla al 100% del contenedor */
    border-collapse: collapse;
    /* Colapsar los bordes de las celdas */
    margin: 20px auto;
    /* Margen exterior y centrado horizontalmente */
    font-family: Arial, sans-serif;
    /* Fuente de texto */
}

table,
th,
td {
    color: #000000;
    border: 2px solid #003770;
    /* Borde de las celdas */
}
table th:first-child {
    width: 70px;
  }
th,
td {
    padding: 8px;
    /* Espaciado interno de celdas */
    text-align: left;
    /* Alineación del texto a la izquierda */
}

th {
    background-color: #E30613;
    color: white;
    /* Color de fondo para las celdas de encabezado */
}

tr:nth-child(even) {
    background-color: #f2f2f2;
    /* Color de fondo para filas pares */
}

/* Hover sobre las filas */
tr:hover {
    background-color: #185a9f;
}

caption {
    caption-side: top;
    /* Ubicación de la leyenda de la tabla */
    font-weight: bold;
    /* Texto de la leyenda en negrita */
    margin-bottom: 10px;
    /* Espaciado inferior de la leyenda */
}

/* Estilo para la primera columna (si es necesario) */
td:first-child {  
    background-color: #c4babada;
}


/* Estilo para la última columna (si es necesario) */
/*td:last-child {
    background-color: #ddd;
}

/* Estilo para una clase específica de celdas (si es necesario) */
/*td.miClase {
    background-color: yellow;
}*/
.vistatabla {
    width: 100%;
    /* Ancho de la tabla al 100% del contenedor */
    border-collapse: collapse;
    /* Colapsar los bordes de las celdas */
    margin: 20px auto;
    /* Margen exterior y centrado horizontalmente */
    font-family: Arial, sans-serif;
    /* Fuente de texto */
}

@media(max-width:991px) {
    .menu {
        padding: 10px;
    }

    .menu label {
        display: initial;
        /* float: right; */

    }

    .back {
        padding: 47px 0;
    }

    .menu .navbar {
        position: absolute;
        top: 0%;
        left: 0;
        /* right: 0; */
        width: auto;
        /* Cambia el ancho automaticamente dependiendo al texto*/
        height: 100vh;
        background-color: #003770;
        display: none;
        z-index: 1;
        /* Asegura que el menú esté en la parte superior */


    }

    .menu .navbar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu .navbar ul li {
        display: block;
        /* Configura los elementos de la lista como bloques */
        margin-bottom: 10px;
        /* Espacio entre elementos de la lista */


        /* margin-bottom: 100px; Espacio entre elementos de la lista */
    }

    .menu .navbar ul li a {

        font-size: 18px;
        padding: 20px;
        color: white;
        display: block;
        font-family: Arial, sans-serif;
    }

    #menu:checked~.navbar {
        display: block;
    }

    /* CSS para el contenedor de botones */
    .botonesss {
        display: flex;
        /* Usa flexbox para alinear los botones */
        flex-wrap: wrap;
        /* Permite que los botones se envuelvan en líneas cuando el espacio es insuficiente */
        justify-content: center;
        /* Centra horizontalmente los botones */
    }

    /* CSS para todos los botones */
    .botones {
        margin: 10px;
        /* Espacio entre los botones (ajusta según tus preferencias) */
    }



    .vistatabla {
        overflow-x: auto;
    }

    .vistatabla table {
        width: 100%;
    }

    .vistatabla th,
    .vistatabla td {
        white-space: nowrap;
    }

    /* Opcional: Puedes ocultar algunas columnas en pantallas pequeñas si es necesario */
    .vistatabla td:nth-child(2),
    .vistatabla th:nth-child(2) {
        display: none;
    }
}

    .centered-container {
    text-align: center;
    }
    .styled-button {
            width: 10%;
            height: 100%;
            background: rgba(4, 36, 60, 0.99);
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
            border: 1px solid rgba(198, 69, 196, 0.30);
            color: #fff; 
            padding: 1% 2%;
            }
</style>


<body>
    <nav>


        <div class="logo">
            <a href="#" class="logo2">
                <img src="/images/Logo_TE.png" alt="Logo de la Empresa" class="company-logo">
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
    <header>



        {{-- <div class="back">
            <div class="menu container">



                <a href="#" class="logo">
                    <img src="images/Logo_TE.png" alt="Logo de la Empresa" class="company-logo">
                    Administrador de Elecciones
                    <br>
                    Universidad Mayor de San Simon

                </a>
                <input type="checkbox" id="menu" />
                <label for="menu">
                    <img src="images/menu.png" class="menu-icono" alt="">
                </label>
                <nav class="navbar">
                    <ul>
                        <li><a href="#">Salir</a></li>
                        
                        <li class="icon-list">
                            <a href="#" class="admin-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <span class="admin-text">Administrador</span>
                            </a>
                        </li>
                        
                        


                    </ul>
                </nav>
            </div>
        </div> --}}
    </header>


    <section class="fondoo" id="fondoo">
        <br>
        <br>
        <br>
        <center>
            <h1>Lista de Mesas</h1>
        </center>
        <br>
        <br>
        @if(auth()->user()->name == 'admin')
        <div class="container botonesss">


            <div class="botones">
                <a href="{{ url('mesas/create') }}" class="buttons">Crear Mesa</a>

            </div>


        </div>
            @endif


        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table id="mesasTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>Id de Eleccion</th>
                                <th>N° de Mesa</th>
                                <th>Tipo Votante</th>
                                <th>Votantes en mesa</th>
                                <th>Carrera</th>
                                <th>Ubicación</th>
                                <th>Nº de votantes</th>
                                @if(auth()->user()->name == 'admin')
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($mesascreadas as $mesas)
                                <tr>
                                    <td>{{ $mesas->id_de_eleccion }}</td>
                                    <td>{{ $mesas->numeromesa}}</td>
                                    <td>{{ $mesas->votantemesa }}</td>
                                    <td>{{ $mesas->votantesenmesa}}</td>
                                    <td>{{ $mesas->carreramesa }}</td>
                                    <td>{{ $mesas->ubicacionmesa }}</td>
                                    <td>{{ $mesas->numerodevotantes }}</td>
                                    
                                    @if(auth()->user()->name == 'admin')
                                    <td class="celda-botones">
                                    
                                    {{-- <a href="{{ url('/mesas/' . $mesas->id . '/generate-jurados') }}" class="buttons" 
                                    style="background-color: 04243C; color: #FFF; padding: 5px 10px; border: none; cursor: pointer;">Generar Jurados </a>


                                    <a href="{{ url('/mesas/' . $mesas->id . '/lista-jurados') }}" class="buttons"
                                    style="background-color: 04243C; color: #FFF; padding: 5px 10px; border: none; cursor: pointer;">Lista de Jurados</a> --}}

                                    <button class="buttons-dentro-tabla" title="Informacion Mesa" 
                                    onclick="window.location.href='{{ route('mesas.previsualizacion', ['id' => $mesas->id]) }}'">
                                        <img src="/images/informacion.png" alt="Previsualizar" class="formato-imagen" />
                                    </button>

                                     <button class="buttons-dentro-tabla" title="Registrar Resultados"
                                      onclick="window.location.href='{{ route('mesas.registroResultados', $mesas->id) }}'" class="buttons'" >
                                     <img src="/images/registrarresultado.png" alt="Registrar Resultados" class="formato-imagen" />
                                     </button>

                                     <button class="buttons-dentro-tabla" title="Editar Resultados"
                                      onclick="window.location.href='{{ route('mesas.editarResultados', $mesas->id) }}'" class="buttons'" >
                                     <img src="/images/editarresultado.png" alt="Registrar Resultados" class="formato-imagen" />
                                     </button>
                                    
                                    <button class="buttons-dentro-tabla" title="Generar Jurados"
                                    onclick="window.location.href='{{ url('/mesas/' . $mesas->id . '/generate-jurados') }}'" class="buttons'" >
                                   <img src="/images/generarjurados.png" alt="Editar" class="formato-imagen" />
                                </button>


                                    <button class="buttons-dentro-tabla" title="Lista de Jurados"
                                    onclick="window.location.href='{{ url('/mesas/' . $mesas->id . '/lista-jurados') }}'">
                                   <img src="/images/listajurados.png" alt="Editar" class="formato-imagen" />
                                </button>


                                <button class="buttons-dentro-tabla" title="Previsualizar acta" 
                                    onclick="window.location.href='{{ url('/mesas/' . $mesas->id . '/acta')}}'" class="buttons'">
                                        <img src="/images/previ.png" alt="Previsualizar" class="formato-imagen" />
                                    </button>


                                    <button class="buttons-dentro-tabla" title="Editar Elección"
                                     onclick="window.location.href='{{ url('/mesas/' . $mesas->id . '/edit') }}'">
                                    <img src="/images/editar.png" alt="Editar" class="formato-imagen" />
                                 </button>
                                               
                                 
                                 {{-- Inicio Función borrar --}}
                                    <form id="delete-form-{{ $mesas->id }}" action="{{ url('/mesas/' . $mesas->id) }}" method="post" style="display: inline;">
                                    @csrf
                                 {{ method_field('DELETE') }}
                                     <button class="buttons-dentro-tabla" title="Borrar Mesa" onclick="return confirm ('Quieres borrar esta mesa?')">
                                      <img src="/images/borrar.png" alt="Borrar" class="formato-imagen" />
                                      </button>
                                       </form>
                                 {{-- Fin función borrar --}}
                                 
                                 </td>                                                                  
                                 @endif
                                
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <div class="footer">

<div class="footer-izq">
    Av. Oquendo y calle Jordán 
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
    </section>
</body>

</html>