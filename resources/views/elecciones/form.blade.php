<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear/Editar una elección</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/Form.css') }}">


    <script>
        function confirmarCancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/elecciones";
            }
        }

        function confirmarConfirmacion() {
            var confirmacion = confirm("Estas seguro de registrar esta eleccion?");
            if (confirmacion) {

                window.location.href = "/home";
            }
        }
    </script>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
      const selectedDate = new Date(document.getElementById('fecha').value);
      const currentDate = new Date();
  
      if (selectedDate < currentDate) {
        event.preventDefault(); // Detiene el envío del formulario
        alert('Selecciona una fecha igual o posterior al día de hoy.');
      }
    });
  </script>
  
    <style>
        
    .error-message {
    color: red;
    font-size: 12px;
    margin-top: -10px; 
    display: block;
}
    </style>

</head>

<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo2">
                <img src="/images/Logo_TE.png" alt="Logo de Enrique" class="company-logo">
                
            </a>
            <div><a href="{{ url('/') }}">TRIBUNAL ELECTORAL</a></div>
            
            <div><a href="{{ url('/') }}">UNIVERSITARIO</a></div>
        </div>
        <ul>
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>
            <li></li><li></li>

        <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="{{ url('/comunicados') }}">Comunicados</a></li>
            <li><a href="#">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contactos</a></li> --}}
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <header></header>
    <div class="header">
        <label for=""></label><br><br>
    </div>
    <div class="container">
        <form action="{{ isset($elecciones) ? url('/elecciones/' . $elecciones->id) : url('/elecciones') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($elecciones))
                {{ method_field('PATCH') }}
            @endif
            <h2 class="form-title">Registrar Elección</h2>
            
            <div class="columns">
                <div class="column">
                <label for="nombre">Nombre de la Elección:</label>
                   <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9]+/g, '')" name="nombre" maxlength="40"
                   placeholder="Escribe el nombre de la elección aquí..."
                   value="{{ isset($elecciones) ? $elecciones->nombre : old('nombre') }}" required>
                   @error('nombre')
                   <span class="error-message">{{ $message }}</span>
                   @enderror

                   <label for="motivo">Motivo de la Elección:</label>
                   <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9]+/g, '')" name="motivo" maxlength="60"
                   placeholder="Escribe el motivo de la elección aquí..."
                   value="{{ isset($elecciones) ? $elecciones->motivo : old('motivo') }}" id="motivo" required>
                   @error('motivo')
                   <span class="error-message">{{ $message }}</span>
                   @enderror

                   <label for="cargodeautoridad">Cargo de Autoridad:</label>
                   <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,. ]+/g, '')"
                   name="cargodeautoridad" placeholder="Escribe el cargo de autoridad aquí..." maxlength="30"
                   value="{{ isset($elecciones) ? $elecciones->cargodeautoridad : old('cargodeautoridad') }}" id="cargodeautoridad"
                   required>
                   @error('cargodeautoridad')
                   <span class="error-message">{{ $message }}</span>
                   @enderror

                   <label for="gestioninicio">Gestión (Inicio y Fin):</label>
<select name="gestioninicio" id="gestionicio" required>
    <option value="">Selecciona un año</option>
    @for ($year = date('Y'); $year <= 2150; $year++)
        <option value="{{ $year }}"
            @if (isset($elecciones) && $elecciones->gestion && $year == explode(' - ', $elecciones->gestioninicio)[0])
                selected
            @endif>
            {{ $year }}
        </option>
    @endfor
</select>
-
<select name="gestionfin" id="gestionfin" required>
    <option value="">Selecciona un año</option>
    @for ($year = date('Y'); $year <= 2150; $year++)
        <option value="{{ $year }}"
            @if (isset($elecciones) && $elecciones->gestion && $year == explode(' - ', $elecciones->gestionfin)[1])
                selected
            @endif>
            {{ $year }}
        </option>
    @endfor
</select>

<br><br>


                        <label for="tipodevotantes">Tipo de Votantes:</label>
                           <select name="tipodevotantes" id="tipodevotantes" required>
                             <option value="">Selecciona el tipo de votante</option>
                             <option value="Estudiantes" {{ isset($elecciones) && $elecciones->tipodevotantes === 'Estudiantes' ? 'selected' : '' }}>Estudiantes</option>
                             <option value="Docentes" {{ isset($elecciones) && $elecciones->tipodevotantes === 'Docentes' ? 'selected' : '' }}>Docentes</option>
                             <option value="Administrativos" {{ isset($elecciones) && $elecciones->tipodevotantes === 'Administrativos' ? 'selected' : '' }}>Administrativos</option>
                             <option value="General" {{ isset($elecciones) && $elecciones->tipodevotantes === 'General' ? 'selected' : '' }}>General</option>
                            </select><br><br>

                    <label for="fechainscripcion">Fecha de inscripcion de frentes:</label>
                    <input type="date" name="fechainscripcion" value="{{ isset($elecciones) ? $elecciones->fechainscripcion : '' }}"
                        id="fechainscripcion" required min="<?php echo date('Y-m-d'); ?>">

                </div>
                <div class="column">
                    <label for="convocatoria">Convocatoria (PDF):</label>
                    @if (isset($elecciones) && $elecciones->convocatoria)
                        <p>{{ $elecciones->convocatoria }}</p>
                    @endif
                    <input type="file" accept="application/pdf" title="Subir Archivo PDF" name="convocatoria"
                        {{ isset($elecciones) && $elecciones->convocatoria ? '' : 'required' }}>
<br>
<br>
<br>
<br>
                    <label for="fecha">Fecha de eleccion:</label>
                    <input type="date" name="fecha" value="{{ isset($elecciones) ? $elecciones->fecha : '' }}"
                        id="fecha" required min="<?php echo date('Y-m-d'); ?>">


                        <label for="tipodeeleccion">Tipo de Elección:</label>
                         <select name="tipodeeleccion" id="tipodeeleccion" required>
                            <option value="">Selecciona el tipo de elección</option>
                            <option value="Universitaria" {{ isset($elecciones) && $elecciones->tipodeeleccion === 'Universitaria' ? 'selected' : '' }}>Universitaria</option>
                            <option value="Facultativa" {{ isset($elecciones) && $elecciones->tipodeeleccion === 'Facultativa' ? 'selected' : '' }}>Facultativa</option>
                            <option value="Carrera" {{ isset($elecciones) && $elecciones->tipodeeleccion === 'Carrera' ? 'selected' : '' }}>Carrera</option>
                        </select><br><br>


                    <label for="descripcion">Descripción:</label>
                    <textarea oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9-]+/g, '')" name="descripcion" maxlength="300"
                        placeholder="Escribe la descripción de la elección aquí..." id="descripcion" rows="4">{{ isset($elecciones) ? $elecciones->descripcion : '' }}</textarea>
                </div>
            </div>
            <input type="submit" value="{{ isset($elecciones) ? 'Actualizar' : 'Registrar' }}"
                onclick="confirmarConfirmacion()">
            <input type="reset" value="Cancelar" onclick="confirmarCancelación()">
            <label for=""></label><br><br>
            <label for=""></label><br><br>
        </form>
        <div class="footer">

            <div class="footer-izq">
                Av. Oquendo y calle Jordán asd
                <br>
                Mail: Tribunal_electoral@umss.edu
                <br>
                www.umss.edu.bo Cochabamba - Bolivia
                <br>
                Design: DevGenius

            </div>
            <div class="footer-medio">

                Copyright © 2023 Tribunal Electoral Universitario Todos los derechos Reservados

            </div>
            <div class="footer-der">
                <a href="{{ url('/') }}">Acerca de</a>
                <span>&nbsp;|&nbsp;</span> <!-- Para agregar un separador -->
                <a href="{{ url('/') }}">Contactos</a>

            </div>

        </div>
    </div>
</body>

</html>