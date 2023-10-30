<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear/Editar jurados</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/Form.css') }}">


    <script>
        function confirmarCancelacion() {
            var confirmacion = confirm("¿Seguro que deseas cancelar? Los cambios no se guardarán.");
            if (confirmacion) {

                window.location.href = "/jurados/jurados";
            }
        }

        function confirmarConfirmacion() {
            var confirmacion = confirm("Los datos han sido registrados con éxito");
            if (confirmacion) {

                window.location.href = "/jurados/jurados";
            }
        }
    </script>

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
            <li><a href="#">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li> --}}
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <header></header>
    <div class="header">
    <label for=""></label><br><br>
    </div>
    <div class="container">
        <form action="{{ isset($jurados) ? url('/jurados/' . $jurados->id) : url('/jurados') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @if (isset($jurados))
                {{ method_field('PATCH') }}
            @endif
            <h2 class="form-title">Editar jurado</h2>
            <br>
                <div class="column">

                    <label for="iddeeleccion">ideleccion:</label>
                    <input type="number"  name="iddeeleccion"
                        placeholder="Escribe el nombre del miembro aquí..."
                        value="{{ isset($jurados) ? $jurados->iddeeleccion : '' }}" id="iddeeleccion" required>

                    <label for="idmesa">idmesa:</label>
                    <input type="number" 
                        name="idmesa" placeholder="Escribe el apellido paterno aquí..."
                        value="{{ isset($jurados) ? $jurados->idmesa : '' }}" id="idmesa"
                        required>

                        <label for="nombres">nombres:</label>
                    <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,.]+/g, '')"
                        name="nombres" placeholder="Escribe el apellido materno aquí..."
                        value="{{ isset($jurados) ? $jurados->nombres : '' }}" id="nombres"
                        required>

                        <label for="apellidoPaterno">Apellido Materno:</label>
                    <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,.]+/g, '')"
                        name="apellidoPaterno" placeholder="Escribe el apellido materno aquí..."
                        value="{{ isset($jurados) ? $jurados->apellidoPaterno : '' }}" id="apellidoPaterno"
                        required>

                        <label for="apellidoMaterno">Apellido Materno:</label>
                    <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z,.]+/g, '')"
                        name="apellidoMaterno" placeholder="Escribe el apellido materno aquí..."
                        value="{{ isset($comite) ? $comite->apellidoMaterno : '' }}" id="apellidoMaterno"
                        required>

                        <label for="codSis">codSis:</label>
                    <input type="number" 
                        name="codSis" placeholder="Escribe el codSis"
                        value="{{ isset($jurados) ? $jurados->codSis : '' }}" id="codSis"
                        required>

                        <label for="CI">CI:</label>
                    <input type="text" 
                        name="CI" placeholder="Escribe el carnet de identidad"
                        value="{{ isset($jurados) ? $jurados->CI : '' }}" id="CI"
                        required>

                        <label for="tipojurado">tipojurado:</label>
                    <input type="text" 
                        name="tipojurado" placeholder="Escribe el tipo de jurado"
                        value="{{ isset($jurados) ? $jurados->tipojurado : '' }}" id="tipojurado"
                        required>

                   

                </div>
            <input type="submit" value="{{ isset($jurados) ? 'Actualizar' : 'Registrar' }}"
                onclick="confirmarConfirmacion()">
            <input type="reset" value="Cancelar" onclick="confirmarCancelación()">
            
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