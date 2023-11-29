@extends('layouts.header_footer')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cargar Backup</title>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <style>
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
    </style>
    <body>
        <div class="container">
        <form action="{{ route('cargar.backup') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                  
            

                <h2 class="form-title">Restablecer Backup</h2>

                <div class="column">

                    <label for="titulo">Seleccionar Archivo de Backup (.sql):</label><br><br>
                    <input type="file" name="archivo_backup" accept=".sql" required onchange="mostrarMensaje()">
                    <br><br><br>
                    

                    
           <input type="submit" value="{{ 'Cargar' }}" onclick="return confirm ('¿Está seguro que desea cargar este backup?')">
                    <input type="reset" value="Cancelar" onclick="cancelacion()">
                </div>
            </form>
        </div>
    </body>
    <script>
  function mostrarMensaje() {
            alert('Archivo seleccionado. Si confirmas la carga de este archivo, entiendes y aceptas que se eliminara la informacion no guardada y sera remplazada por la que esta subiendo.');
        }
        function cancelacion() {
        var confirmacion = confirm("¿Seguro que deseas cancelar?");
            if (confirmacion) {
        
                window.location.href = "/elecciones";
            }
        }
    </script> 




</html>