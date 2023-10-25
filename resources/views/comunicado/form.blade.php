@extends('layouts.header_footer')
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear/Editar comunicado</title>
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
            <form action="{{ isset($comunicado) ? url('/comunicados/' . $comunicado->id) : url('/comunicados') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @if (isset($comunicado))
                    {{ method_field('PATCH') }}
                @endif

                <h2 class="form-title">Registrar Comunicado</h2>

                <div class="column">

                    <label for="titulo">Título:</label>
                    @error('titulo')<span style="color:red">{{ $message }}</span> @enderror
                    <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z0-9, .\-]+/g, '')"
                    name="titulo" placeholder="Escribe el titulo del comunicado..." value="{{ isset($comunicado) ? $comunicado->titulo : '' }}" id="titulo" maxlength="180" required
                    >
                    
                    <div class="file-upload-container">
                        <label for="pdf">Archivo(PDF):</label>
                        @if (isset($comunicado) && $comunicado->pdf)
                            <p>{{ $comunicado->pdf}}</p>
                        @endif
                        <input type="file" accept="application/pdf" title="Subir archivo PDF" name="pdf"
                            {{ isset($comunicado) && $comunicado->pdf ? '' : 'required' }} 
                        >
                        @error('pdf')<span style="color:red">{{ $message }}</span> @enderror
                    </div>
                    
                    <!--<label for="inicio">Fecha de Inicio:</label>
                    <input type="date" id="inicio" name="inicio" 
                    value="{{ isset($comunicado) ? $comunicado->inicio : '' }}" required 
                    min="{{ now()->subDays(1)->format('Y-m-d') }}">-->

                    <label for="fin">Fecha Fin:</label>
                    <input type="date" id="fin" name="fin"
                    value="{{ isset($comunicado) ? $comunicado->fin : '' }}"
                    min="{{ now()->addDay(1)->format('Y-m-d') }}">

                    <input type="submit" value="{{ isset($comunicado) ? 'Actualizar' : 'Registrar' }}" onclick="return confirm ('¿Está seguro que registrar este comunicado?')">
                    <input type="reset" value="Cancelar" onclick="cancelacion()">
                </div>
            </form>
        </div>
    </body>
    <script>

        function cancelacion() {
        var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {
        
                window.location.href = "/comunicados";
            }
        }
    </script>
</html>
