{{-- crear/editar mesas --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mesa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing:border-box;
            font-family: "Uni Sans" , sans-serif;
        }
        .company-logo {
            border-radius: 8%;
            max-width: 15%;
            height: auto;
            float: left;
            margin-right: 40px;
        }
        nav {
            display:flex;
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
            font-size:25px;
            color:#fff;
            font-weight: 600;
            text-decoration:none;
        }
        nav .logo a:hover {
            color: #003770;
            transition: 0.5s;
        }
        nav ul {
            display: flex;
            align-items: center;
            justify-content:center;
            gap:2.5rem;
        }
        nav ul li{
            list-style: none;
        }
        nav ul li a{
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }
        nav ul li a:hover{
            color: #003770;
            transition: 0.5s;
        }
        
        .menu-icon{
            display: none;
            width: 25px;
            height:3px;
            background: #fff;
            transform: translateY(-50%);
            transition: 0.5s;
            border-radius:5px;
            cursor: pointer;
        }
        .menu-icon::before,
        .menu-icon::after{
            content:"";
            position: absolute;
            width: 25px;
            height:3px;
            background: #fff;
            transition:0.5s;
            border-radius: 5px;
        }
        .menu-icon::before{
            top:-8px;
        }
        .menu-icon::after{
            top:-8px;
        }
        .menu-icon.active{
            background: rgba(0,0,0,0);
        }
        .menu-icon.active::before{
            top:0;
            transform:rotate(45deg);
        }
        .menu-icon.active::after{
            top:0;
            transform: rotate(135deg);
        }
        @media screen and (max-width:992px){
            nav ul{
                position:fixed;
                top: 0px;
                right:100%;
                width:100%;
                height: 90vh;
                background: #004a92;
                flex-direction: column;
                transition: 0.5s ease-in;
            }
            nav ul li a{
                font-size: 24px;
            }
            ul.active{
                right: 0;
                transition: 0.5s ease-in;
            }
            .menu-icon{
                display: block;
            }
        }
        
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
            padding: 2px 0;
        }
        
        .mesa-form-container {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }

        .mesa-form-container .form-title {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .mesa-columns {
            display: flex;
            justify-content: space-between;
        }

        .mesa-column {
            flex: 1;
            padding: 10px;
        }
        

        /* Estilo para el selector de "Tipo de Votante" */
        #tipoVotante {
            flex: 1; /* Ocupa todo el espacio restante en la línea */
            margin-right: 10px; /* Agrega un margen derecho entre los elementos */
        }   

        /* Estilo para el elemento de "Cantidad" */
        #cantidad {
            font-weight: bold; /* Opcional: Estiliza la fuente en negrita */
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        input[type="number"],
        select {
        width: 95%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        
        input[type="submit"]{
            background-color: #04243C;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;   
            margin-bottom: 10px; 
        }
        input[type="reset"]{
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
        .centered {
            text-align: center; 
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
    <div class="header">
            <label for=""></label><br><br>
           
            </div>
            <div class="mesa-form-container">
            <form action="{{ isset($mesas) ? url('/mesas/' . $mesas->id) : url('/mesas') }}"
            method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($mesas))
                {{ method_field('PATCH') }}
            @endif
        <label for=""></label><br><br>
        <h2 class="form-title">Registrar Mesas de Votacion</h2>
        <div class="column">

        <label for="id_de_eleccion">Elección asociada:</label>
             <select name="id_de_eleccion" id="id_de_eleccion" required {{ $editar ? 'disabled' : '' }}>
            <option value="">Selecciona una elección</option>
             @if (isset($elecciones))
              @foreach ($elecciones as $eleccion)
            <option value="{{ $eleccion->id }}" {{ (isset($mesas) && $mesas->id_de_eleccion == $eleccion->id) ? 'selected' : '' }}>
                {{ $eleccion->nombre }}
            </option>
              @endforeach
              @endif
              </select>
              <span class="error-message">{{ $errors->first('id_de_eleccion') }}</span>
               <br><br>

                <div class="campo-adicional" id="facultadmesa">
                <label for="facultadmesa">Facultad de la mesa:</label>
                <select name="facultadmesa" id="facultadmesaSelect" required>
                <option value="">Selecciona una facultad</option>
                 </select>
                <span class="error-message">{{ $errors->first('facultadmesa') }}</span>
                </div><br><br> 

                <div class="campo-adicional" id="carreramesa">
                 <label for="carreramesa">Carrera:</label>
                <select name="carreramesa" id="carreramesaSelect" required>
                </select>
                </div><br><br> 

                 @if ($editar)
                  <label for="ubicacionmesa">Ubicacion de mesa:</label>
                  <input type="text" placeholder="Escribe la ubicacion aquí..." maxlength="40" 
                    oninput="this.value = this.value.replace(/[^A-Za-z,. 0-9]+/g, '')"
                    name="ubicacionmesa" value="{{ isset($mesas) ? $mesas->ubicacionmesa : '' }}" id="mesas" required><br><br>
                 @endif

                 <div class="campo-adicional">
                 <label for="numeroMesas" id="cantidadMesasLabel" style="display: none;">Cantidad de Mesas:</label>
                 <input type="number" name="numeroMesas" id="cantidadMesasInput" value="1" min="1" style="display: none;" required>
                 </div>


                {{--
                <label for=""></label>
                <div class="campo-adicional">
                <label for="numeroMesas">Número de Mesas:</label>
                <div class="input-group">
                    <input type="number" name="numeroMesas" id="numeroMesas" value="1" min="1">
                    
                </div>
                <label for=""></label>--}}
                
                <br><br>      
                
        </div>
        <div class="botones centered">
            <input type="submit" value="{{ isset($mesas) ? 'Actualizar' : 'Crear' }}"  onclick="return confirm ('¿Está seguro que registrar esta(s) Mesa(s)?')">
            <input type="reset" value="Cancelar" onclick="cancelacion()">
            <label for=""></label><br><br>
            <label for=""></label><br><br>
        </div>


    </form>
    <div class="footer">

        <div class="footer-izq">
            Av. Oquendo y calle Jordán 
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

    <script>
document.addEventListener('DOMContentLoaded', function () {
    // ...

    var cantidadMesasLabel = document.getElementById('cantidadMesasLabel');
    var cantidadMesasInput = document.getElementById('cantidadMesasInput');
    var carreraSelect = document.getElementById('carreramesaSelect');

    // ...

    // Manejar el cambio en la selección de carrera
    carreraSelect.addEventListener('change', function () {
        // Obtener la carrera seleccionada
        var selectedCarrera = carreraSelect.value;

        // Mostrar u ocultar el texto y el campo "Cantidad de Mesas" según la selección
        cantidadMesasLabel.style.display = selectedCarrera ? 'block' : 'none';
        cantidadMesasInput.style.display = selectedCarrera ? 'block' : 'none';
        
        // Si se selecciona una carrera, habilitar el campo
        if (selectedCarrera) {
            cantidadMesasInput.disabled = false;
        } else {
            // Si no se selecciona una carrera, deshabilitar y reiniciar el valor
            cantidadMesasInput.disabled = true;
            cantidadMesasInput.value = '1';
        }
    });
});
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var facultadSelect = document.getElementById('facultadmesaSelect');
        var carreraSelect = document.getElementById('carreramesaSelect');

    // Lista de facultades predefinidas
    var facultadesPredefinidas = [
        "Humanidades Y Cs. De Educación",
        "Ciencias Jurídicas y Políticas",
        "Arquitectura y Ciencias del Hábitat",
        "Ciencias Económicas",
        "Ciencias y Tecnología",
        "Ciencias Sociales",
        "Medicina",
        "Odontología",
        "Cs .Farmacéuticas Y Bioquímicas",
        "Enfermería",
        "Ciencias Agrícolas Y Pecuarias",
        "Desarrollo Rural y Territorial",
        "Ciencias Veterinarias",
        "Politécnica del Valle Alto"
    ];

    var carrerasPorFacultad = {
        "Humanidades Y Cs. De Educación": [
                "Psicología",
                "Ciencias de la Educación",
                "Lingüística Aplicada a la Enseñanza de Lenguas",
                "Comunicación Social",
                "Trabajo Social",
                "Música",
                "Ciencias de la Actividad Física y Deportes",
                "Licenciatura especial en Educación Intercultural Bilingüe"
            ],
            "Ciencias Jurídicas y Políticas": [
                "Ciencias Jurídicas",
                "Ciencias Políticas"
            ],
            "Arquitectura y Ciencias del Hábitat": [
                "Arquitectura",
                "Diseño gráfico y Comunicación Visual",
                "Turismo",
                "Diseño de Interiores y del Mobiliario",
                "Planificación del Territorio y el Medio Ambiente",
                "Construcciones"
            ],
            "Ciencias Económicas": [
                "Economía",
                "Administración de Empresas",
                "Contaduría Pública",
                "Ingeniería Comercial",
                "Ingeniería Financiera"
            ],
            "Ciencias y Tecnología": [
                "Alimentos",
                "Biología",
                "Civil",
                "Mecánica",
                "Electromecánica",
                "Industrial",
                "Eléctrica",
                "Electrónica",
                "Informática",
                "Sistemas",
                "Quimica",
                "Matemáticas",
                "Matemáticas",
                "Física",
                "Química",
                "Petroquimica"
            ],
            "Ciencias Sociales": [
                "Sociología",
                "Antropología"
            ],
            "Medicina": [
                "Medicina",
                "Fisioterapia y kinesiología",
                "Nutrición y Dietética"
            ],
            "Odontología": [
                "Odontologia"
            ],
            "Farmacéuticas Y Bioquímicas": [
                "Ciencias Farmacéuticas",
                "Bioquimica"
            ],
            "Enfermería": [
                "Enfermeria"
            ],
            "Ciencias Agrícolas Y Pecuarias": [
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
            "Desarrollo Rural y Territorial": [
                "Tecnico Superior en Agronomia",
                "Produccion Agraria y Desarrollo Territoria"
            ],
            "Ciencias Veterinarias": [
                "Medicina Veterinaria y Zootecnia"
            ],
            "Politécnica del Valle Alto": [
                "Técnico Universitario Superior en Construcción Civil",
                "Progr Compl en Mecánica Automotriz y Maquinaria Agroindustrial",
                "Técnico Universitario Superior en Mecánica Automotriz",
                "Técnico Universitario Superior en Mecánica Industrial",
                "Técnico Universitario Superior en Química Industrial",
                "Técnico Universitario Superior en Industria de Alimentos",
                "Técnico Universitario Medio en Enfermería"
            ]
        };

    // Llenar el campo de facultad con las opciones predefinidas
    facultadesPredefinidas.forEach(function (facultad) {
            var opcionElemento = document.createElement('option');
            opcionElemento.value = facultad;
            opcionElemento.text = facultad;
            facultadSelect.appendChild(opcionElemento);
        });

        // Manejar el cambio en la selección de facultad
        facultadSelect.addEventListener('change', function () {
            // Obtener la facultad seleccionada
            var selectedFacultad = facultadSelect.value;
            
            // Limpiar las opciones actuales en el campo de carreras
            carreraSelect.innerHTML = '<option value="">Selecciona una carrera</option>';

            // Obtener las carreras correspondientes a la facultad seleccionada
            var carreras = carrerasPorFacultad[selectedFacultad] || [];

            // Llenar el campo de carreras con las opciones correspondientes
            carreras.forEach(function (carrera) {
                var opcionElemento = document.createElement('option');
                opcionElemento.value = carrera;
                opcionElemento.text = carrera;
                carreraSelect.appendChild(opcionElemento);
            });
        });
    });
    </script>
    
    <script>
        function cancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/mesas";
            }
        }

        function confirmacion() {
            var confirmacion = confirm("Estas seguro de registrar esta(s) mesa(s)?");
            if (confirmacion) {

                window.location.href = "/mesas";    
            }
        }

    </script>



</div>
    
</body>
</html> 