@extends('layouts.header_footer');

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes</title>
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
            margin-top: 70px ;
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
        
        .container {
            display: flex;
            max-width: 1300px;
            overflow-x: auto;
            text-align: left;
            margin-left: 10px;
        }

        .table-column {
            flex: 1; /* Take up 50% of the container */
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
        table,th,td {
            color: #000000;
            border: 2px solid #003770;
        }
        /*Espaciado*/
        th,td {
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
            background-color: #f2f2f2;
        }
        /* Hover sobre las filas */
        tr:hover {
            background-color: #185a9f;
        }
        /* Estilo para la primera columna (si es necesario) */
        td:first-child {  
            background-color: #c4babada;
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

.custom-table th, .custom-table td {
    /* Establecer un ancho máximo para las celdas */
    max-width: 350px; /* Puedes ajustar este valor según tus necesidades */
    overflow:scroll;
    text-overflow:clip;
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
                margin-top: 20px; /* Add margin to create space between table and chart */
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

            .contenedor{
                margin-bottom: 200px;
            }
        }


    </style>
</head>
<body>
    <div class="contenedor">
        <form action="{{ route('logs.filter') }}" method="GET">
            @csrf
            <div class="titulo">
                <h1>Bitácora del Sistema</h1>  
            </div>
            <div class="entradas">
                <div class="input-container">
                    <label for="start_date">Fecha de inicio:</label>
                    <input type="date" name="start_date" required value="{{ old('start_date') }}">
                </div>

                <div class="input-container">
                    <label for="end_date">Fecha de final:</label>
                    <input type="date" name="end_date" required value="{{ old('end_date') }}">
                </div>

                <div class="input-container">
                    <label for="nombreusuario" class="tipRep">Usuario:</label>
                    <select name="nombreusuario" id="nombreusuario" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach ($usuariosRegistrados as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>          
            <button type="submit" class="generar-reporte">Buscar Registros</button>        
        </form>
        @if(isset($logs) && count($logs) > 0)
            <div class="container">
                <div class="table-column">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th data-columna="user_id">Id Usuario</th>
                                <th data-columna="user">Usuario</th>
                                <th  data-columna="action">Accion</th>
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
</body>
</html>