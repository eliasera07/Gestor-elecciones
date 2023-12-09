@extends('layouts.header_footer');

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitácora</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
            text-align: center;
            font-weight: 400;
        }

        .titulo h1 {
            /*margin-right: 1000px;*/
            text-align: center;
        }

        .contenedor {
            /*max-width: 1300px;*/
            margin: 20px;
            margin-top: 70px;
            margin-bottom: 80px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            /*height: 600px; */
        }

        .entradas {
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
            padding-top: 10px;
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
        input[type="text"] {
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

        .container {
            display: flex;
            max-width: 1300px;
            overflow-x: auto;
            text-align: left;
            margin-left: 10px;
        }

        .table-column {
            flex: 1;
            /* Take up 50% of the container */
            padding: 10px;
        }

        /*tabla*/
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        /*Bordes*/
        table,
        th,
        td {
            color: #000000;
            border: 2px solid #003770;
        }

        /*Espaciado*/
        th,
        td {
            padding: 8px;
            text-align: left;
        }

        /*Encabezado*/
        th {
            background-color: #E30613;
            color: white;
        }

        /* Color de fondo para filas pares */
        tr:nth-child(even) {
            background-color: #c1c1c1;
        }

        /* Hover sobre las filas */
        tr:hover {
            background-color: #185a9f;

        }

        tr:hover td {
            color: white;
        }

        /* Estilo para la primera columna (si es necesario) */
        td:first-child {
            background-color: #c1c1c1;
        }


        .grafico {
            padding: 5px;
            background-color: #003770;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        /* .custom-table {
    width: 10%;
} */

        .custom-table th,
        .custom-table td {
            /* Establecer un ancho máximo para las celdas */
            max-width: 350px;
            /* Puedes ajustar este valor según tus necesidades */
            overflow: scroll;
            text-overflow: clip;
            white-space: nowrap;
        }


        /* Estilo para las demás columnas */


        @media only screen and (max-width: 706px) {

            th,
            td {
                padding: 4px;
                font-size: 14px;
            }

            .entradas {
                flex-direction: column;
            }

            #myChart {
                margin-left: 0;
                margin-top: 20px;
                /* Add margin to create space between table and chart */
            }

        }

        @media only screen and (max-width: 1024px) {
            .entradas {
                flex-direction: column;
            }

            #myChart {
                margin: auto;
            }

            .container {
                flex-direction: column;
            }

            .contenedor {
                margin-bottom: 200px;
            }
        }

        #no-results-message {
            display: none;
            color: red;
            text-align: center;
            margin-top: 10px;
            font-size: 30px;
            /* Puedes ajustar este valor según tus preferencias */
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <form action="{{ route('logs.filter') }}" method="GET" onsubmit="saveFormValues()">
            @csrf
            <div class="titulo">
                <h1>Bitácora del Sistema</h1>
            </div>
            <div class="entradas">
                <div class="input-container">
                    <label for="start_date">Fecha de inicio:</label>
                    <input type="date" name="start_date" required value="{{ old('start_date', $start_date) }}">
                </div>

                <div class="input-container">
                    <label for="end_date">Fecha de final:</label>
                    <input type="date" name="end_date" required value="{{ old('end_date', $end_date) }}">
                </div>

                <div class="input-container">
                    <label for="nombreusuario" class="tipRep">Usuario:</label>
                    <select name="nombreusuario" id="nombreusuario" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach ($usuariosRegistrados as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ old('nombreusuario', $selected_user) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="generar-reporte">Buscar Registros</button>
        </form>

        <div class="search-container">
            <label for="search">Buscar en la lista:</label>
            <input type="text" id="search" name="search" placeholder="Escribe una palabra...">
            <button type="button" class="buscar"
                style="background-color: #003770; color: #fff; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer;"
                onclick="searchTable()">Buscar</button>
            <button type="button" class="borrar"
                style="background-color: #E30613; color: #fff; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer;"
                onclick="clearSearch()">Borrar</button>
        </div>



        <div id="no-results-message"
            style="display: none; color: red; text-align: center; margin-top: 10px; font-size: 18px;">Sin resultados
        </div>



        @if (isset($logs) && count($logs) > 0)
            <div class="container">
                <div class="table-column">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th data-columna="user_id">Id Usuario</th>
                                <th data-columna="user">Usuario</th>
                                <th data-columna="action">Accion</th>
                                <th class="columna-ancho" data-columna="old_data">Registro Pasado</th>
                                <th class="columna-ancho" data-columna="new_data">Registro Nuevo</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr class="fila-resaltada">
                                    <td>{{ $log->user_id }}</td>
                                    <td>{{ optional($log->user)->name }}</td>
                                    <td>{{ $log->action . ' en ' . $log->table_name }}</td>
                                    <td>{{ $log->old_data }}</td>
                                    <td>{{ $log->new_data }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h3 style="color: #185a9f; text-align: center; padding: 10px;">Resultados Actuales: 0</h3>
        @endif
    </div>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.querySelector(".custom-table");
            tr = table.getElementsByTagName("tr");

            // Agrega una variable para verificar si se encontraron resultados
            var foundResults = false;

            for (i = 0; i < tr.length; i++) {
                if (i === 0) {
                    continue; // Saltar la primera fila (encabezados de la tabla)
                }

                let found = false; // Indicador de si se encontró la cadena en alguna columna

                // Recorrer todas las celdas excepto Usuario e Id Usuario
                for (j = 0; j < tr[i].cells.length; j++) {
                    if (j !== 0 && j !== 1) { // Ignorar las columnas Usuario e Id Usuario
                        td = tr[i].cells[j];
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true; // Se encontró la cadena en esta columna
                            foundResults = true; // Se encontraron resultados en general
                            break; // No es necesario verificar más columnas
                        }
                    }
                }

                // Mostrar u ocultar cada celda según si se encontró la cadena en esa columna
                for (j = 0; j < tr[i].cells.length; j++) {
                    td = tr[i].cells[j];
                    if (j !== 0 && j !== 1) { // Ignorar las columnas Usuario e Id Usuario
                        td.style.display = found ? "" : "none";
                    }
                }

                // Mostrar u ocultar toda la fila si se encontró la cadena en alguna columna
                tr[i].style.display = found ? "" : "none";
            }

            // Mostrar u ocultar el mensaje "Sin resultados" según si se encontraron resultados en general
            var noResultsMessage = document.getElementById("no-results-message");
            noResultsMessage.style.display = foundResults ? "none" : "block";
        }
    </script>
    <script>
        // Función para guardar los valores del formulario en cookies
        function saveFormValues() {
            document.cookie = "start_date=" + encodeURIComponent(document.getElementsByName('start_date')[0].value);
            document.cookie = "end_date=" + encodeURIComponent(document.getElementsByName('end_date')[0].value);
            document.cookie = "nombreusuario=" + encodeURIComponent(document.getElementsByName('nombreusuario')[0].value);
        }

        // Función para leer el valor de una cookie
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }

        // Función para establecer los valores del formulario al cargar la página
        window.onload = function() {
            var start_date_cookie = getCookie("start_date");
            if (start_date_cookie) {
                document.getElementsByName('start_date')[0].value = decodeURIComponent(start_date_cookie);
            }

            var end_date_cookie = getCookie("end_date");
            if (end_date_cookie) {
                document.getElementsByName('end_date')[0].value = decodeURIComponent(end_date_cookie);
            }

            var nombreusuario_cookie = getCookie("nombreusuario");
            if (nombreusuario_cookie) {
                document.getElementsByName('nombreusuario')[0].value = decodeURIComponent(nombreusuario_cookie);
            }
        };
    </script>

    <script>
        function clearSearch() {
            document.getElementById("search").value = "";
            searchTable(); // Puedes llamar a la función de búsqueda para actualizar los resultados después de borrar.
        }
    </script>

</body>


</html>