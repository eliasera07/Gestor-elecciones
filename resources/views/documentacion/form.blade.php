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
            <form action="{{ isset($documentacion) ? url('/documentaciones/' . $documentacion->id) : url('/documentaciones') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @if (isset($documentacion))
                    {{ method_field('PATCH') }}
                @endif

                <h2 class="form-title">Registrar Documento</h2>

                <div class="column">
                <label for="idEleccionD">Elección:</label>
                    <select name="idEleccionD" id="idEleccionD" required>
                        <option value="">Selecciona una elección</option>
                            @if (isset($elecciones))
                                @foreach ($elecciones as $eleccion)
                                    <option value="{{ $eleccion->id }}" @if(isset($documentacion) && $documentacion->ideleccion == $eleccion->id) selected @endif>{{ $eleccion->nombre }}</option>
                                @endforeach
                            @endif
                    </select><br><br>
                        @error('idEleccionD')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                            
                    <label for="titulo">Título:</label>
                    @error('titulo')<span style="color:red">{{ $message }}</span> @enderror
                    <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9]+/g, '')" maxlength="40"
                    name="titulo" placeholder="Escribe el título del documento..." value="{{ isset($documentacion) ? $documentacion->titulo : '' }}" id="titulo" maxlength="180" required
                    >
                    <label for="tipodedocumento">Tipo de Documento:</label>
                        <select name="tipodedocumento" id="tipodedocumento" required>
                            <option value="">Selecciona el tipo de documento</option>
                            <option value="Acta" {{ isset($documentacion) && $documentacion->tipodedocumento === 'Acta' ? 'selected' : '' }}>Acta</option>
                            <option value="Impugnacion" {{ isset($documentacion) && $documentacion->tipodedocumento === 'Impugnacion' ? 'selected' : '' }}>Impugnación</option>
                            <option value="Observacion" {{ isset($documentacion) && $documentacion->tipodedocumento === 'Observacion' ? 'selected' : '' }}>Observación</option>
                        </select><br><br>
                    <div class="file-upload-container">
                        <label for="pdf">Archivo(PDF):</label>
                        @if (isset($documentacion) && $documentacion->pdf)
                            <p>{{ $documentacion->pdf}}</p>
                            <embed src="{{ asset('storage/' . $documentacion->pdf) }}" type="">
                        @endif
                        <input type="file" accept="application/pdf" title="Subir archivo PDF" name="pdf"
                            {{ isset($documentacion) && $documentacion->pdf ? '' : 'required' }} 
                        >
                        @error('pdf')<span style="color:red">{{ $message }}</span> @enderror
                    </div>
                    
                    <input type="submit" value="{{ isset($documetacion) ? 'Actualizar' : 'Registrar' }}" onclick="return confirm ('¿Está seguro que registrar este documento?')">
                    <input type="reset" value="Cancelar" onclick="cancelacion()">
                </div>
            </form>
        </div>
    </body>
    <script>

        function cancelacion() {
        var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {
        
                window.location.href = "/documentaciones";
            }
        }
    </script>
</html>