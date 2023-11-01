@extends('layouts.header_footer')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imprimir Boleta de Sufragio</title>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <style>

@media screen {
        /* Estilos para la visualización en pantalla */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Tus otros estilos de pantalla aquí */
    }

    /* Estilos para impresión */
    @media print {
        /* Estilos para la impresión en papel */
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; /* Fondo blanco para impresión */
        }

        /* Estilos para ocultar elementos en la impresión */
        .no-print {
            display: none;
        }
    }



        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%; 
            max-width: 100%; 
            padding: 10px;
            margin-bottom: 10px; 
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #04243C;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        input[type="reset"] {
            background-color: #A70606;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 0;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        .container {                
            max-width: 700px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-title {
            font-size: 28px;
            margin-bottom: 30px;
            margin-top: 40px;
            text-align: center;
        }

        .file-upload-container label {
            display: inline-block;
            margin-right: 10px; 
        }

        .column {
            flex: 1;
            padding: 10px;
            /*display: flex;*/
            flex-direction: column;
        }

        .column input[type="text"],
        .column input[type="file"] {
            margin-bottom: 20px; 
        }

        .column input[type="date"]{
            margin-bottom: 50px; 
            
        }

        .frentes-container {
    display: flex;
    flex-wrap: wrap; /* Permite que los elementos se envuelvan si no caben en una sola línea */
    justify-content: space-between; /* Espacio igual entre elementos */
}

.frente-item {
    flex-basis: calc(33.33% - 20px); /* Ancho de un tercio con márgenes */
    margin-bottom: 20px; /* Espacio entre elementos */
}

.empty-box {
    width: 100px; /* Ancho del recuadro vacío */
    height: 100px; /* Altura del recuadro vacío */
    border: 1px solid #000; /* Borde del recuadro */
    margin-right: 10px; /* Espacio entre el recuadro y el nombre del frente */
    display: inline-block; /* Para que los elementos se muestren en línea */
}

    </style>

<script>
        function confirmarCancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? La impresion se cancelara.");
            if (confirmacion) {

                window.location.href = "/elecciones";
            }
        }
    </script>

<body>
    <div class="container">
        <h1>Imprimir Boleta de Sufragio</h1>
        <br><br>
        <label for="">Nombre de Eleccion</label>
        <p>{{ $eleccion->nombre }}</p>
        <p>{{ $eleccion->motivo }}</p>
        <p>{{ $eleccion->cargoautoridad }}</p>

        <br><br>

        <h3>Frentes:</h3>
        <div class="frentes-container">
            @foreach ($frentes as $frente)
            <div class="frente-item">
                <div class="frente-details">
                    <p>{{ $frente->nombrefrente }}</p>
                    <img src="{{ asset('storage').'/'.$frente->fotofrente }}" alt="" width="250" height="250">
                    <p>Cargo: {{ $frente->cargopostulacion }}</p>
                    <br><br>
                    <p>Marca tu voto aqui:</p>
                    <div class="empty-box"></div> <!-- Recuadro vacío -->
                </div>
            </div>
            @endforeach
        </div>

        <br><br>
        

        <input type="submit" value="{{ 'Imprimir' }}" onclick="imprimirBoleta()">
            <input type="reset" value="Cancelar" onclick="confirmarCancelación()">
    </div>

    <script>
        function imprimirBoleta() {
            // Oculta los botones de impresión y cancelar para que no se impriman
            var botones = document.querySelectorAll(".no-print");
            for (var i = 0; i < botones.length; i++) {
                botones[i].style.display = "none";
            }
            // Imprime la boleta
            window.print();
        }
    </script>
</body>
    
</html>
