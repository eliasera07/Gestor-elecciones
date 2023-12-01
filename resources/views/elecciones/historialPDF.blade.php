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
            max-width: 1000px;
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
            <input type="button" value="Volver al historial" onclick="confirmarCancelacion()" class= "cancelar">
        </div>

        <h2>Reporte de la elección</h2>
        <br><br>

        <h4 >Datos de la elección</h4>

        <h4>Título de la elección: <label class="outputs">{{$registro->nombre}}</label></h4>
        
        <h4 >Fecha de la elección: <label class="outputs">{{ date('d/m/Y', strtotime($registro->fecha)) }}</label></h4>
        
        <h4 >Motivo de la elección: <label class="outputs">{{$registro->motivo}}</label></h4>
        
        <h4 >Cargo de autoridad: <label class="outputs">{{$registro->cargodeautoridad}}</label></h4>
        
        <h4>Gestión: <label class="outputs">{{$registro->gestioninicio}} - {{$registro->gestionfin}}</label></h4>
        
        <h4>Tipo de elección: <label class="outputs">{{ $registro->tipodeeleccion }}</label></h4>
        
        <h4>Descripción: <label class="outputs">{{$registro->descripcion}}</label></h4>

        <br>

        <h4 style="font-weight: bold">Resultados</h4>

        <h4>Número de votos: <label class="outputs">{{$suma}}</label></h4>
        {{--<h4>Número de No votantes: <label class="outputs">{{$nroVotantes-$suma}}</label></h4>--}}
        <h4>Frente Ganador: <label class="outputs">{{$frenteGanador}}</label></h4>

        <div class="container">
            <div class="table-column">
                <table style="font-size: smaller;">
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
        <br>
        <h4 id="graf">Gráfico General</h4>
        <br>

        
        <canvas id="myChart"></canvas>

        <br>
        <br>
        <h4>Comité Electoral</h4>
    
        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>CI</th>
                            <th>Cargo en el comité:</th>
                            <th>Profesión</th>
                            <th>Cargo en la UMSS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comites as $comite)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $comite->apellidoPaterno }} {{ $comite->apellidoMaterno }}</td>
                                <td>{{ $comite->nombreMiembro }}</td>
                                <td>{{ $comite->CI }}</td>
                                <td>{{ $comite->cargoComite }}</td>
                                <td>{{ $comite->profesion }}</td>
                                <td>{{ isset($comite->cargoUMSS) ? $comite->cargoUMSS : 'Sin dato' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        <br>
        <h4>Frentes</h4>

        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre de Frente</th>
                            <th>1er Candidato</th>
                            <th>2do Candidato</th>
                            <th>3er Candidato</th>
                            <th>4to Candidato </th>
                            <th>Cargo de Postulación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frentes as $frente)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $frente->nombrefrente }}</td>
                                <td>{{ $frente->nombrecandidato1 }}</td>
                                <td>{{ $frente->nombrecandidato2 }}</td>
                                <td>{{ $frente->nombrecandidato3 }}</td>
                                <td>{{ $frente->nombrecandidato4 }}</td>
                                <td>{{ $frente->cargopostulacion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        <br>
        <h4>Mesas</h4>

        <h4 >Número de mesas habilitadas: <label class="outputs">{{ $mesas }}</label></h4>

        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Mesa</th>
                            <th>Tipo</th>
                            <th>Apellidos</th>
                            <th>Facultad</th>
                            <th>Carrera</th>
                            <th>Ubicación</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mesasTotal as $mesas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mesas->numeromesa}}</td>
                                <td>{{ $mesas->votantemesa }}</td>
                                <td>{{ $mesas->votantesenmesa}}</td>
                                <td>{{ $mesas->facultadmesa }}</td>
                                <td>{{ $mesas->carreramesa }}</td>
                                <td>{{ $mesas->ubicacionmesa }}</td>
                                <td>{{ $mesas->numerodevotantes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        <br>
        <h4>Jurados por cada mesa</h4>

        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Mesa</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Código Sis</th>
                            <th>CI</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurados as $jurado)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jurado->idmesa }}</td>
                                <td>{{ $jurado->apellidoPaterno }} {{ $jurado->apellidoMaterno }}</td>
                                <td>{{ $jurado->nombres }}</td>
                                <td>{{ $jurado->codSis }}</td>
                                <td>{{ $jurado->CI }}</td>
                                <td>{{ $jurado->tipojurado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        <br>
        <h4>Votantes</h4>

        <h4 >Número de votantes habilitados: <label class="outputs">{{$nroVotantes}}</label></h4>

        <div class="container">
            <div class="table-column">
                <table>
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Código Sis</th>
                            <th>CI</th>
                            <th>Facultad</th>
                            <th>Carrera</th>
                            <th>Celular</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votantes as $votante)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $votante->apellidoPaterno }} {{ $votante->apellidoMaterno }}</td>
                                <td>{{ $votante->nombres }}</td>
                                <td>{{ $votante->codSis }}</td>
                                <td>{{ $votante->CI}}</td>
                                <td>{{ $votante->facultad }}</td>
                                <td>{{ $votante->carrera }}</td>
                                <td>{{ $votante->celular }}</td>
                                <td>{{ $votante->tipoVotante }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
            window.location.href = "/historial";
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