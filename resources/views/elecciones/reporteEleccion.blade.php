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

        .contenedor {
            max-width: 780px;
            margin: 70px auto 80px; /* margen superior, centrado horizontalmente, margen inferior */
            background-color: #fff;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            /*align-items: center; /* Centrar horizontalmente */
            justify-content: center; /* Centrar verticalmente */
        }


        .outputs{
            font-weight: 100;
        }

        .comite{
            margin-left: 100px;
            margin-bottom: 0px;
        }

        #myChart {
            max-width: 300px;
            max-height: 300px;
            width: 100%; /* Asegura que ocupa el ancho máximo permitido */
            height: auto; /* Ajusta la altura automáticamente */
            display: block; /* Asegura que sea un elemento de bloque */
            margin: auto; /* Centra horizontal y verticalmente */
        }


        h2{
            text-align: center;
        }

        h4, .subs{
            margin: 3px;
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
            border: 2px solid  #000000;
        }
        /*Espaciado*/
        th,td {
            padding: 8px;
            text-align: left;
        }
        /*Encabezado*/
        th {
            background-color: #c4babada;
            color: black;
        }
        /* Color de fondo para filas pares */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Estilo para la primera columna (si es necesario) */
        td:first-child {  
            background-color: #c4babada;
        }

        #graf{
            text-align: center;
        }

        .subs {
            margin-left: 70px;
            margin-bottom: 2px;
        }

        input[type="submit"] {
            background-color: #04243C;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .cancelar {
            background-color: #A70606;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .botones-imprimir {
            text-align: right;
        }
        


    </style>
</head>
<body>
    <div class="contenedor">
        <div class="botones-imprimir">
            <input type="submit" value="{{ 'Imprimir' }}" onclick="imprimirBoleta()" id="botonImprimir">
            <input type="button" value="Volver a elecciones" onclick="confirmarCancelacion()" class= "cancelar">
        </div>
        <br>
        <h2>Reporte de la elección</h2>
        <br><br>

        <h4 >Datos la elección</h4>

        <h4 class="subs">Título de la elección: <label class="outputs">{{$registro->nombre}}</label></h4 class="subs">
        
        <h4 class="subs">Fecha de la elección: <label class="outputs">{{ date('d/m/Y', strtotime($registro->fecha)) }}</label></h4 class="subs">
        
        <h4 class="subs">Motivo de la elección: <label class="outputs">{{$registro->motivo}}</label></h4 class="subs">
        
        <h4 class="subs">Cargo de autoridad: <label class="outputs">{{$registro->cargodeautoridad}}</label></h4 class="subs">
        
        <h4 class="subs">Gestión: <label class="outputs">{{$registro->gestioninicio}} - {{$registro->gestionfin}}</label></h4 class="subs">
        
        <h4 class="subs">Tipo de elección: <label class="outputs">{{ $registro->tipodeeleccion }}</label></h4 class="subs">
        
        <h4 class="subs">Descripción: <label class="outputs">{{$registro->descripcion}}</label></h4>

        <br>
        <h4>Datos de votantes y mesas</h4>

        <h4 class="subs">Tipo de votantes: <label class="outputs">{{ $registro->tipodevotantes }}</label></h4 class="subs">
        <h4 class="subs">Número de votantes habilitados: <label class="outputs">{{$nroVotantes}}</label></h4 class="subs">
        <h4 class="subs">Número de mesas habilitadas: <label class="outputs">{{ $mesas }}</label></h4 class="subs">

            <br>
        <h4>Comité Electoral</h4>
    
        <h4 class="subs">Integrantes del comité electoral:</h4 class="subs">
            <br>
            @foreach ($comites as $comite)
                <label class="comite">
                    {{ $loop->iteration }} . {{ $comite->nombreMiembro }} {{ $comite->apellidoPaterno }} {{ $comite->apellidoMaterno }}
                </label><br>
            @endforeach
            <br>
        <h4 style="font-weight: bold">Resultados</h4>

        <h4 class="subs">Número de votos: <label class="outputs">{{$suma}}</label></h4 class="subs">
        {{--<h4 class="subs">Número de No votantes: <label class="outputs">{{$nroVotantes-$suma}}</label></h4 class="subs">--}}


        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre del frente</th>
                            <th>Nro de votos</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($registro->nombrefrente1)
                            <tr>
                                <td>1</td>
                                <td>{{ $registro->nombrefrente1 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente1: 0 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente1 / $suma * 100 : 0 }}%</td>
                            </tr>
                        @endif
                
                        @if($registro->nombrefrente2)
                            <tr>
                                <td>2</td>
                                <td>{{ $registro->nombrefrente2 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente2 : 0 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente2 / $suma * 100 : 0 }} %</td>
                            </tr>
                        @endif
                
                        @if($registro->nombrefrente3)
                            <tr>
                                <td>3</td>
                                <td>{{ $registro->nombrefrente3 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente3 : 0}}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente3 / $suma * 100 : 0 }} %</td>
                            </tr>
                        @endif
                
                        @if($registro->nombrefrente4)
                            <tr>
                                <td>4</td>
                                <td>{{ $registro->nombrefrente4 }}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente4 : 0}}</td>
                                <td>{{ $suma != 0 ? $registro->votosfrente4 / $suma * 100 : 0 }} %</td>
                            </tr>
                        @endif

                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td>{{$suma}}</td>
                            <td>{{ $suma != 0 ? $suma / $suma * 100 : 0 }} %</td>
                        </tr>

                    </tbody>
                </table>
                
            </div>
        </div>

        <h4 id="graf">Gráfico de frentes</h4>
        <br>
        
        <canvas id="myChart"></canvas>

  
        
        
    </div>  

    <script>
        function imprimirBoleta() {
            // Oculta los botones al imprimir

            document.querySelector('.botones-imprimir').style.display = 'none';
            window.print();

            // Muestra los botones después de un segundo
            setTimeout(function() {
                document.querySelector('.botones-imprimir').style.display = 'block';
            }, 1000);
        }

        function confirmarCancelacion() {
            // Redirige a la página de historial
            window.location.href = "/elecciones";
        }
    </script>

    
    
</body>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var data = @json($data);

        var myChart = new Chart(ctx, {
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
                responsive: false,
                maintainAspectRatio: false,
                width: 300,
                height: 300,
            }
        });
    </script>


</html>