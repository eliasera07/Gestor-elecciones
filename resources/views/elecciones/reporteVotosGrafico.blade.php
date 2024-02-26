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
            margin-bottom: 120px;
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

        #mychart {
            margin-left: auto;
            margin-right: auto;
            display: block; 
        }
        .grafico {
            padding: 5px;
            background-color: #003770;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

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
        <form action="/reporte" method="GET">
            @csrf
            
                <div class="titulo">
                        <h1>Reporte de Elecciones</h1>  
                </div>
                <div class="entradas">
                    <div class="input-container">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" name="fecha_inicio" required value="{{ $fechas['fecha_inicio'] }}">
                    </div>

                    <div class="input-container">
                        <label for="fecha_fin">Fecha de final:</label>
                        <input type="date" name="fecha_fin" required value="{{ $fechas['fecha_fin'] }}">
                    </div>

                    <div class="input-container">
                        <label for="tipo" class="tipRep">Tipo de Reporte:</label>
                        <select name="tipo" id="tipRep" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Numero de votos" {{ $fechas['tipo'] === 'Numero de votos' ? 'selected' : '' }}>Número de Votos</option>
                            {{--<option value="Numero de votantes" {{ $fechas['tipo'] === 'Numero de votantes' ? 'selected' : '' }}>Numero de Votantes</option>--}}
                            <option value="Reporte por frentes" {{ $fechas['tipo'] === 'Reporte por frentes' ? 'selected' : '' }}>Reporte por frentes</option>
                        </select>
                    </div>     
                </div>          
                <button type="submit" class="generar-reporte">Generar Reporte</button>        
        </form>
        @if(isset($registros) && count($registros) > 0)
            <div class="container">
                <div class="table-column">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Tipo de <br>elección</th>
                                <th>Tipo de <br>votantes</th>
                                <th>Nombre <br>Frente 1</th>
                                <th>Votos <br>Frente 1</th>
                                <th>Nombre <br>Frente 2</th>
                                <th>Votos <br>Frente 2</th>
                                <th>Nombre <br>Frente 3</th>
                                <th>Votos <br>Frente 3</th>
                                <th>Nombre <br>Frente 4</th>
                                <th>Votos <br>Frente 4</th>
                                <th>Nro de <br>votantes</th>
                                <th>Frente <br>ganador</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($registros as $registro)
                                <tr>
                                    <td>{{ $registro->nombre }}</td>
                                    <td>{{ $registro->fecha }}</td>
                                    <td>{{ $registro->tipodeeleccion }}</td>
                                    <td>{{ $registro->tipodevotantes }}</td>

                                    <td>{{ isset($registro->nombrefrente1) ? $registro->nombrefrente1 : '----'}}</td>
                                    <td>{{ isset($registro->votosfrente1) ? $registro->votosfrente1 : '----'}}</td>

                                    <td>{{ isset($registro->nombrefrente2) ? $registro->nombrefrente2 : '----'}}</td>
                                    <td>{{ isset($registro->votosfrente2) ? $registro->votosfrente2 : '----'}}</td>

                                    <td>{{ isset($registro->nombrefrente3) ? $registro->nombrefrente3 : '----'}}</td>
                                    <td>{{ isset($registro->votosfrente3) ? $registro->votosfrente3 : '----'}}</td>

                                    <td>{{ isset($registro->nombrefrente4) ? $registro->nombrefrente4 : '----'}}</td>
                                    <td>{{ isset($registro->votosfrente4) ? $registro->votosfrente4 : '----'}}</td>

                                    <td>{{ isset($nroVotantesPorRegistro[$registro->id]) ? $nroVotantesPorRegistro[$registro->id] : 0 }}</td>
                                    <td>{{ isset($frentesG[$registro->id]) ? $frentesG[$registro->id]->nombrefrente : '----' }}</td>
                                    <td>
                                        <form action="/reporteGrafico/{{ $registro->id }}" method="get">
                                            <button type="submit" class= "grafico">Gráfico</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table> 
                </div>
               
                <canvas id="myChart"></canvas>

            </div>
        @else
            <h3 style="color: #185a9f;; text-align: center; padding: 10px;">Resultados Actuales: 0</h3>
        @endif
    </div>  

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var data = @json($data);

        var myChart = new Chart(ctx, {
            //type: 'doughnut', 
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(255, 255, 0, 0.8)',  
                        'rgba(169, 169, 169, 0.8)',
                    ],
                }]
            },
            options: {
                responsive: false, // Desactiva la respuesta automática al tamaño del contenedor
                maintainAspectRatio: false, // No mantenga la relación de aspecto fija
                width: 400, // Ancho del gráfico
                height: 300, // Alto del gráfico
            }
        });

    </script>
</body>
</html>

