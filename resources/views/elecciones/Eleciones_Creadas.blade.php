<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Elecciones Creadas</title>
    <link rel="stylesheet" href="{{ asset('css/Elecciones_Creadas.css') }}">
    <script src="{{ asset('js/Elecciones_Creadas.js') }}"></script>

</head>

<body>
    <header>



        <div class="back">
            <div class="menu container">



                <a href="#" class="logo">
                    <img src="images/Logo_TE.png" alt="Logo de la Empresa" class="company-logo">
                    Tribunal Electoral
                    <br>
                    Universitario

                </a>
                <input type="checkbox" id="menu" />
                <label for="menu">
                    <img src="images/menu.png" class="menu-icono" alt="">
                </label>
                <nav class="navbar">
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Inicio</a></li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>


    <section class="fondoo" id="fondoo">
        <br>
        <br>
        <br>
        <center>
            <h1>Lista de Eleeciones Creadas</h1>
        </center>
        <br>
        <br>
        <br>
        <div class="container botonesss">


            <div class="botones">
                <button class="buttons">Crear nueva elección</button>
            </div>

            <div class="botones">
                <input type="text" id="search" placeholder="Buscar...">
                <button class="buttons" onclick="search()">Buscar</button>
            </div>


        </div>


        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table id="eleccionesTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <td>Ejemplo</td>
                            <td>Debe de salide la DB</td>
                            <td>q</td>
                            <td>q</td>
                            <td>q</td>
                            <td>q</td>

                            <tr>
                                <td>Ejemplo2</td>
                                <td>q</td>
                                <td>q</td>
                                <td>q</td>
                                <td>q</td>
                            </tr>
                            <!-- Here you can add the rows dynamically using JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
