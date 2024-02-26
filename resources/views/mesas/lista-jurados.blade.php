<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear jurado</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>

<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo2">
                <img src="/images/Logo_TE.png" alt="Lo" class="company-logo">
                
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
    <header>
    <div class="header">
        <label for=""></label><br><br>
    </div>

    <div class=" menu container">
        <form action="{{ isset($elecciones) ? url('/elecciones/' . $elecciones->id) : url('/elecciones') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($elecciones))
                {{ method_field('PATCH') }}
            @endif
            @if(isset($eleccion))
            <h2 class="form-title1">{{ $eleccion->nombre }}</h2>
            @endif
            <br><br>
            <h2 class="form-title">Lista de Jurados</h2>


            
           
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
    margin: 20px auto;
    background-color: #fff;
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

input[type="submit"] {
    background-color: #04243C;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="reset"] {
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


              .elecciones-section {
            background-color: white; 
            padding: 20px;
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
        <style>
            .elecciones-section {
                background-color: white;
                padding: 20px;
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

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid #ddd;
            }

            th, td {
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #EE0F0F;
                color: #FFFFFF;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            .edit-button {
                background-color: #04243C;
                color: #FFF;
                padding: 5px 5px;
                border: none;
                cursor: pointer;
            }
            .botones {

            display: inline-block;
            margin-right: 10px;
            }
            .botones {
             margin: 10px;
        /* Espacio entre los botones (ajusta según tus preferencias) */
            }
        </style>
</head>
<body>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div class="centered-container">
<div class="botones">
                <a href="{{ url('mesas/create') }}" class="buttons">Crear Mesa</a>

            </div>
            
<section class="elecciones-section">
        <div class="container">

            <table id="juradosTable" class="vistatabla">
                <thead>
                    <tr>
                        <th>Id de elección</th>
                        <th>N° Mesa</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Cargo Jurado</th>
                        <th>Cambiar Jurado</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jurados as $jurado)
    <tr>
        <td>{{ $jurado->iddeeleccion }}</td>
        <td>{{ $jurado->idmesa }}</td>
        <td>{{ $jurado->nombres }}</td>
        <td>{{ $jurado->apellidoPaterno }}</td>
        <td>{{ $jurado->apellidoMaterno }}</td>
        <td>{{ $jurado->tipojurado }}</td>
        
        <td class="celda-botones">
    <a href="{{ route('jurados.edit', ['id' => $jurado->id]) }}" class="buttons-dentro-tabla">
        <img src="/images/editar.png" alt="Editar" class="formato-imagen" />
    </a>
</td>


    </tr>
@endforeach
                </tbody>
            </table>
        </div>
        <br><br>
        <br><br>
        <br><br>
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
            <a href="{{ url('/acercade') }}">Acerca de | Contactos</a>
            <!--<span>&nbsp;|&nbsp;</span> 
            <a href="#">Contactos</a>-->

            </div>

        </div>
        </tr>
        </tbody>
                    
        </table>
    </div>
    </section>
</body>

</html>