<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear/Editar una Elección</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/Elecciones_Creadas.js') }}"></script>

    


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

                window.location.href = "/elecciones";
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

    /* Estilos del encabezado */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Uni Sans", sans-serif;
}

.company-logo {
    border-radius: 8%;

    max-width: 15%;
    /* Ajusta el ancho máximo de la imagen al 100% del contenedor */
    height: auto;
    /* Permite que la altura se ajuste automáticamente para mantener la proporción */
    /* Alinea verticalmente la imagen en el medio del texto */
    float: left;
    margin-right: 40px;
}

nav {
    display: flex;
    align-items: center;
    justify-content: space-around;
    height: 70px;
    background-image: linear-gradient(to right, #003770, #f80211);
    border-bottom: 2px solid #fff;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 999;
}

nav .logo a {
    font-size: 25px;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}

nav .logo a:hover {
    color: #003770;
    transition: 0.5s;
}

nav ul {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2.5rem;
}

nav ul li {
    list-style: none;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
}

nav ul li a:hover {
    color: #003770;
    transition: 0.5s;
}

.menu-icon {
    display: none;
    width: 25px;
    height: 3px;
    background: #fff;
    transform: translateY(-50%);
    transition: 0.5s;
    border-radius: 5px;
    cursor: pointer;
}

.menu-icon::before,
.menu-icon::after {
    content: "";
    position: absolute;
    width: 25px;
    height: 3px;
    background: #fff;
    transition: 0.5s;
    border-radius: 5px;
}

.menu-icon::before {
    top: -8px;
}

.menu-icon::after {
    top: -8px;
}

.menu-icon.active {
    background: rgba(0, 0, 0, 0);
}

.menu-icon.active::before {
    top: 0;
    transform: rotate(45deg);
}

.menu-icon.active::after {
    top: 0;
    transform: rotate(135deg);
}

@media screen and (max-width:992px) {
    nav ul {
        position: fixed;
        top: 0px;
        right: 100%;
        width: 100%;
        height: 90vh;
        background: #004a92;
        flex-direction: column;
        transition: 0.5s ease-in;
    }

    nav ul li a {
        font-size: 24px;
    }

    ul.active {
        right: 0;
        transition: 0.5s ease-in;
    }

    .menu-icon {
        display: block;
    }
}

/* Estilos del contenido */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.header {
    background-color: white;
    color: white;
    text-align: center;
    padding: 20px 0;
}

.container {
    max-width: 1300px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

.form-title {
    font-size: 28px;
    margin-bottom: 20px;
    text-align: center;
}

input[type="text"],
input[type="number"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="file"] {
    margin-top: 5px;
}

input[type="submit"] {
    background-color: #04243C;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="reset"] {
    background-color: #A70606;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #0056b3;
}

/* Estilos para las columnas */
.columns {
    display: flex;
    justify-content: space-between;
}

.column {
    flex: 1;
    padding: 10px;
}

.footer {
    background-color: #003770;
    color: white;
    padding: 15px;
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    font-size: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-izq {
    flex: 1;

    text-align: left;
    margin-left: 70px;
    /* Ajusta el valor de margen según cuánto espacio desees agregar */


}

.footer-medio {
    text-align: center;
    display: flex;
    align-items: center;
    white-space: nowrap;
    /* Evita el retorno de línea */
    overflow: hidden;
    /* Oculta el desbordamiento si el contenido es demasiado largo */
    text-overflow: ellipsis;
    /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
    display: flex;
    align-items: center;
    white-space: nowrap;
    /* Evita el retorno de línea */
    overflow: hidden;
    /* Oculta el desbordamiento si el contenido es demasiado largo */
    text-overflow: ellipsis;
    /* Agrega puntos suspensivos (...) si el contenido es demasiado largo */
    font-size: 18px;

}

.footer-der {
    flex: 1;
    text-align: center;
}

.footer-der a {
    color: white;
    /* Establece el color del texto en blanco por defecto */
    text-decoration: none;
    /* Elimina el subrayado predeterminado de los enlaces */
    transition: color 0.3s;
    /* Agrega una transición suave para el cambio de color */
    font-size: 18px;
    /* Ajusta el tamaño de fuente según tus preferencias */

}

.footer-der a:hover {
    color: red;
    /* Cambia el color del texto a rojo al pasar el ratón sobre el enlace */
    font-size: 20px;
    /* Tamaño de fuente al pasar el ratón sobre el enlace, puedes ajustarlo según tus preferencias */

}
        
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
            <li><a href="{{ url('/documentaciones') }}">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contactos</a></li> --}}
            <li>
    @if(auth()->check())
        {{-- Si el usuario ha iniciado sesión, mostrar el enlace de Cerrar Sesión --}}
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        {{-- Si el usuario no ha iniciado sesión, mostrar el enlace de Ingreso --}}
        <a href="{{ url('/iniciarsesion') }}">Ingreso</a>
    @endif
</li>
            <img src="/images/img.png"  class="company-logo">
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
                    <select name="gestioninicio" id="gestioninicio" required>
                        <option value="">Selecciona un año</option>
                        @for ($yearIni = date('Y'); $yearIni <= 2150; $yearIni++)
                        <option value="{{ $yearIni }}" @if (isset($elecciones) && $elecciones->gestion && $yearIni == explode(' - ', $elecciones->gestioninicio)[0])
                            selected @endif>
                            {{ $yearIni }}
                        </option>
                        @endfor
                    </select>
                    -
                    <select name="gestionfin" id="gestionfin" required>
                        <option value="">Selecciona un año</option>
                        @for ($year = date('Y'); $year >= $yearIni; $year--)
                        <option value="{{ $year }}" @if (isset($elecciones) && $elecciones->gestion && $year == explode(' - ', $elecciones->gestionfin)[1])
                            selected @endif>
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

                     <div id="facultadField" style="display: none;">
                     <label for="facultad">Facultad:</label>
                     <select name="facultad" id="facultad">
                      <option value="">Selecciona la facultad</option>
                      <option value="Fac. Humanidades Y Cs. De Educación" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Humanidades Y Cs. De Educación' ? 'selected' : '' }}>Fac. Humanidades Y Cs. De Educación</option>
                      <option value="Fac. de Ciencias Jurídicas y Políticas" {{ isset($elecciones) && $elecciones->facultad === 'Fac. de Ciencias Jurídicas y Políticas' ? 'selected' : '' }}>Fac. de Ciencias Jurídicas y Políticas</option>
                      <option value="Fac. Arquitectura y Ciencias del Hábitat" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Arquitectura y Ciencias del Hábitat' ? 'selected' : '' }}>Fac. Arquitectura y Ciencias del Hábitat</option>
                      <option value="Fac. Ciencias Económicas" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Ciencias Económicas' ? 'selected' : '' }}>Fac. Ciencias Económicas</option>
                      <option value="Fac. de Ciencias y Tecnología" {{ isset($elecciones) && $elecciones->facultad === 'Fac. de Ciencias y Tecnología' ? 'selected' : '' }}>Fac. de Ciencias y Tecnología</option>
                      <option value="Fac. Ciencias Sociales" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Ciencias Sociales' ? 'selected' : '' }}>Fac. Ciencias Sociales</option>
                      <option value="Facultad Medicina" {{ isset($elecciones) && $elecciones->facultad === 'Facultad Medicina' ? 'selected' : '' }}>Facultad Medicina</option>
                      <option value="Fac. Odontología" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Odontología' ? 'selected' : '' }}>Fac. Odontología</option>
                      <option value="Fac. Cs .Farmacéuticas Y Bioquímicas" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Cs .Farmacéuticas Y Bioquímicas' ? 'selected' : '' }}>Fac. Cs .Farmacéuticas Y Bioquímicas</option>
                      <option value="Fac. Enfermería" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Enfermería' ? 'selected' : '' }}>Fac. Enfermería</option>
                      <option value="Fac. Ciencias Agrícolas Y Pecuarias" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Ciencias Agrícolas Y Pecuarias' ? 'selected' : '' }}>Fac. Ciencias Agrícolas Y Pecuarias</option>
                      <option value="Fac. Desarrollo Rural y Territorial" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Desarrollo Rural y Territorial' ? 'selected' : '' }}>Fac. Desarrollo Rural y Territorial</option>
                      <option value="Fac. Ciencias Veterinarias" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Ciencias Veterinarias' ? 'selected' : '' }}>Fac. Ciencias Veterinarias</option>
                      <option value="Fac. Politécnica del Valle Alto" {{ isset($elecciones) && $elecciones->facultad === 'Fac. Politécnica del Valle Alto' ? 'selected' : '' }}>Fac. Politécnica del Valle Alto</option>
                     </select><br><br>
                     </div>

                    <div id="carreraField" style="display: none;">
                      <label for="carrera">Carrera:</label>
                     <select name="carrera" id="carrera">
                     <option value="">Selecciona la carrera</option>
                     </select><br><br>
                      </div>

                      <label for="fechainscripcion">Fecha de inscripcion de frentes:</label>
                    <input type="date" name="fechainscripcion" value="{{ isset($elecciones) ? $elecciones->fechainscripcion : '' }}"
                        id="fechainscripcion" required min="<?php echo date('Y-m-d'); ?>" onchange="fechaEleccion()">

                </div>
                <div class="column">
                    <label for="convocatoria">Convocatoria (PDF):</label>
                    @if (isset($elecciones) && $elecciones->convocatoria)
                        <p>{{ $elecciones->convocatoria }}</p>
                        <embed src="{{ asset('storage/' . $elecciones->convocatoria) }}" type="">
                    @endif
                    <input type="file" accept="application/pdf" title="Subir Archivo PDF" name="convocatoria"
                        {{ isset($elecciones) && $elecciones->convocatoria ? '' : 'required' }}>
                        @error('convocatoria')<span style="color:red">{{ $message }}</span> @enderror
            <br>
            <br>
            <br>
            <br>
            <label for="fecha">Fecha de eleccion:</label>
                    <input type="date" name="fecha" value="{{ isset($elecciones) ? $elecciones->fecha : '' }}"
                        id="fecha" required min="<?php echo date('Y-m-d'); ?>" disabled>


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
            onclick="return confirm ('¿Está seguro que registrar esta eleccion?')">
            <input type="reset" value="Cancelar" onclick="confirmarCancelacion()">
            <label for=""></label><br><br>
            <label for=""></label><br><br>
        </form>
        <br><br>
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
            <a href="{{ url('/acercade') }}">Acerca de | Contactos</a>
            <!--<span>&nbsp;|&nbsp;</span> 
            <a href="#">Contactos</a>-->

            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var tipoVotanteInput = document.getElementById('tipodevotantes');
        var facultadField = document.getElementById('facultadField');
        var carreraField = document.getElementById('carreraField');
        var facultadInput = document.getElementById('facultad');
        var carreraInput = document.getElementById('carrera');

        var opcionesCarrera = {
            "Fac. Humanidades Y Cs. De Educación": [
                "Psicología",
                "Ciencias de la Educación",
                "Lingüística Aplicada a la Enseñanza de Lenguas",
                "Comunicación Social",
                "Trabajo Social",
                "Música",
                "Ciencias de la Actividad Física y Deportes",
                "Licenciatura especial en Educación Intercultural Bilingüe"
            ],
            "Fac. de Ciencias Jurídicas y Políticas": [
                "Licenciatura en Ciencias Jurídicas",
                "Licenciatura en Ciencias Políticas"
            ],
            "Fac. Arquitectura y Ciencias del Hábitat": [
                "Arquitectura",
                "Diseño gráfico y Comunicación Visual",
                "Turismo",
                "Diseño de Interiores y del Mobiliario",
                "Planificación del Territorio y el Medio Ambiente",
                "Construcciones"
            ],
            "Fac. Ciencias Económicas": [
                "Economía",
                "Administración de Empresas",
                "Contaduría Pública",
                "Ingeniería Comercial",
                "Ingeniería Financiera"
            ],
            "Fac. de Ciencias y Tecnología": [
                "Ingeniería en Alimentos",
                "Licenciatura en Biología",
                "Ingeniería Civil",
                "Ingeniería Mecánica",
                "Ingeniería Electromecánica",
                "Ingeniería Industrial",
                "Ingeniería Eléctrica",
                "Ingeniería Electrónica",
                "Ingeniería Informática",
                "Ingeniería en Sistemas",
                "Ingeniería Química",
                "Ingeniería en Matemáticas",
                "Licenciatura en Matemáticas",
                "Licenciatura en Física",
                "Licenciatura en Química",
                "Ingeniería Petroquimica"
            ],
            "Fac. Ciencias Sociales": [
                "Sociología",
                "Antropología"
            ],
            "Facultad Medicina": [
                "Medicina",
                "Fisioterapia y kinesiología",
                "Nutrición y Dietética"
            ],
            "Fac. Odontología": [
                "Odontologia"
            ],
            "Fac. Cs .Farmacéuticas Y Bioquímicas": [
                "Ciencias Farmacéuticas",
                "Bioquimica"
            ],
            "Fac. Enfermería": [
                "Enfermeria"
            ],
            "Fac. Ciencias Agrícolas Y Pecuarias": [
                "Agronómica",
                "Agroindustrial",
                "Agrícola",
                "Agronómica Fitotecnista",
                "Agronómica Zootecnista",
                "Tec. Sup. Gestión del Territorio Desarrollo Endógeno Sustentable",
                "Forestal",
                "Tec. Sup. Forestal",
                "Medio Ambiente",
                "Agrícola Tropical y Manejo de Recursos Renovables"
            ],
            "Fac. Desarrollo Rural y Territorial": [
                "Tecnico Superior en Agronomia",
                "Produccion Agraria y Desarrollo Territoria"
            ],
            "Fac. Ciencias Veterinarias": [
                "Medicina Veterinaria y Zootecnia"
            ],
            "Fac. Politécnica del Valle Alto": [
                "Técnico Universitario Superior en Construcción Civil",
                "Progr Compl en Mecánica Automotriz y Maquinaria Agroindustrial",
                "Técnico Universitario Superior en Mecánica Automotriz",
                "Técnico Universitario Superior en Mecánica Industrial",
                "Técnico Universitario Superior en Química Industrial",
                "Técnico Universitario Superior en Industria de Alimentos",
                "Técnico Universitario Medio en Enfermería"
            ]
        };

        function mostrarCamposFacultad() {
            var tipoVotanteSeleccionado = tipoVotanteInput.value;

            if (tipoVotanteSeleccionado === 'Estudiantes' || tipoVotanteSeleccionado === 'Docentes') {
                facultadField.style.display = 'block';
                carreraField.style.display = 'block';
                var facultadSeleccionada = facultadInput.value;
                llenarOpcionesCarrera(facultadSeleccionada);
            } else {
                facultadField.style.display = 'none';
                carreraField.style.display = 'none';
            }
        }

        function llenarOpcionesCarrera(facultadSeleccionada) {

            carreraInput.innerHTML = '<option value="">Selecciona la carrera</option>';

            if (opcionesCarrera.hasOwnProperty(facultadSeleccionada)) {
                opcionesCarrera[facultadSeleccionada].forEach(function (opcion) {
                    var opcionElemento = document.createElement('option');
                    opcionElemento.value = opcion;
                    opcionElemento.text = opcion;
                    carreraInput.appendChild(opcionElemento);
                });
            }
        }

        tipoVotanteInput.addEventListener('change', mostrarCamposFacultad);
        facultadInput.addEventListener('change', function () {
            llenarOpcionesCarrera(facultadInput.value);
        });

        mostrarCamposFacultad();
    });

    function llenarOpcionesCarrera(facultadSeleccionada) {
       
        carreraInput.innerHTML = '<option value="">Selecciona la carrera</option>';

        if (opcionesCarrera.hasOwnProperty(facultadSeleccionada)) {
            opcionesCarrera[facultadSeleccionada].forEach(function (opcion) {
                var opcionElemento = document.createElement('option');
                opcionElemento.value = opcion;
                opcionElemento.text = opcion;
                carreraInput.appendChild(opcionElemento);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {

        var gestionInicioSelect = document.getElementById('gestioninicio');
        var gestionFinSelect = document.getElementById('gestionfin');

        gestionInicioSelect.addEventListener('change', function () {

        var inicioSeleccionado = parseInt(this.value);

        gestionFinSelect.innerHTML = '<option value="">Selecciona un año</option>';
        for (var year = inicioSeleccionado+1; year <= 2150; year++) {
            var option = document.createElement('option');
            option.value = year;
            option.text = year;
            gestionFinSelect.add(option);
        }
        });

        gestionInicioSelect.dispatchEvent(new Event('change'));
    });

</script>

<script>
    function fechaEleccion() {
        var fechaInscripcion = new Date(document.getElementById('fechainscripcion').value);
        var fechaEleccionInput = document.getElementById('fecha');

        var fechaEleccion = new Date(fechaInscripcion);
        fechaEleccion.setDate(fechaEleccion.getDate() + 1);

        if (fechaInscripcion && !isNaN(fechaInscripcion.getTime())) {
            fechaEleccionInput.disabled = false;
            fechaEleccionInput.min = fechaEleccion.toISOString().split('T')[0];
        } else {
            fechaEleccionInput.disabled = true;
            fechaEleccionInput.value = '';
        }
    }
</script>


</body>

</html>