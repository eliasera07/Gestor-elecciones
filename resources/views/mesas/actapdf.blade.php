<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de Elección</title>
</head>

<style>
    /* Estilos CSS aquí */

    body {
        font-family: "Uni Sans" , sans-serif;
        line-height: 1.3;
        font-size: 11px;
        margin: 0; /* Elimina el margen predeterminado */
        padding: 10px;
    }

    header {
        text-align: center;
    }

    header h2 {
        margin-bottom: 10px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    h2 {
        text-align: center;
        font-size: 11px;
        margin-bottom: 10px; /* Espaciado inferior */
    }

    h3, p {
        font-size: 11px;
        
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0; /* Ajuste en el margen de las tablas */
        border: 1px solid #000;
    }

    table, th, td {
        border: 1px solid #000;
    }

    th, td {
        padding: 4px;
        text-align: left;
        line-height: 1;
    }

    th {
        background-color: #E30613;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .container table {
        margin-bottom: 20px; /* Ajuste en el margen inferior de las tablas */
    }
</style>

<body>
    <header>
        <h2>UNIVERSIDAD MAYOR DE SAN SIMÓN</h2>
        <h2>TRIBUNAL ELECTORAL UNIVERSITARIO</h2>
    </header>
    <div class="container">
        <form action="{{ isset($mesas) ? url('/mesas/' . $mesas->id) : url('/mesas') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($mesas))
                {{ method_field('PATCH') }}
            @endif

            
            <h3>Elección a {{ $eleccion->nombre }}</h3> 
            <h2>ACTA DE APERTURA</h2>

            <p>En Cochabamba, a hora {{$horaActual}} del día {{ $fechaFormateada}}, de conformidad con la Convocatoria y el Reglamento Electoral Universitario, se dio inicio al funcionamiento de la mesa {{ $mesa->numeromesa }}.</p>

            <!-- Acta de Apertura - Tabla de Jurados -->
            <table>
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

            <!-- Acta de Cierre - Tabla de Resultados de Frentes -->
            <h2>ACTA DE CIERRE</h2>

            <p>Transcurrida la votación continua se procedió al cierre de la mesa {{ $mesa->numeromesa }}, efectuándose inmediatamente el escrutinio de votos, con los siguientes resultados:</p>

            <table>
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

            <h3>Votos válidos:</h3>
            <h3>Votos blancos:</h3>
            <h3>Votos nulos:</h3>
            <h3>Total de votos emitidos:</h3>

            <!-- Tabla de Jurados al final -->
            <p>Con lo que concluyó el acto en conformidad suscribimos nuestras firmas:</p> 
            <table>
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
                <p style="line-height: 1;">_____________________________________________________________________________________________________________</p>
                <p style="line-height: 1;">_____________________________________________________________________________________________________________</p>
                <p style="line-height: 1;">_____________________________________________________________________________________________________________</p>
            </h3>
        </form>
    </div>
</body>

</html>