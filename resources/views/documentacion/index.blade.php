

<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <br>
    <br>
    <br>
    <title>Documentación</title>
    <link rel="stylesheet" href="{{ asset('css/Elecciones_Creadas.css') }}">

    </head>

<body>
    <nav>
        <div class="logo">
            <a href="#" class="logo2">
                <img src="/images/Logo_TE.png" alt="Logo de la Empresa" class="company-logo">
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
            <li><a href="#">Ingreso</a></li>
            <img src="/images/img.png"  class="company-logo">
        </ul>
        <div class="menu-icon"></div>
    </nav>

    <section class="fondoo" id="fondoo">
        
        <br>
        <br>
        <br>
        <center>
            <h1>Documentación</h1>
        </center>
        <br>
        <br>

        <div class="container botonesss">
            <div class="botones">
                <a href="{{ url('documentaciones/create') }}" class="buttons">Añadir</a>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table id="eleccionesTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>id de Eleccion</th>
                                <th>Título</th>
                                <th>Elección</th>
                                <th>Tipo de documento</th>
                                <th>Añadido el:</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentaciones as $documentacion)
                            <tr>
                              <td>{{ $documentacion->idEleccionD }}</td>
                              <td>{{ $documentacion->titulo }}</td>
                              <td>{{ $documentacion->eleccion->nombre }}</td>
                              <td>{{ $documentacion->tipodedocumento }}</td>
                            <td>
                              @if ($documentacion->inicio)
                              {{ \Carbon\Carbon::parse($documentacion->inicio)->format('d/m/y') }}
                                @else
                                   Sin fecha
                                @endif
                            </td>

                                    <td class="celda-botones">
                                    <button class="buttons-dentro-tabla" title="Editar documento" onclick="window.location.href='{{ url('/documentaciones/' . $documentacion->id . '/edit') }}'">
                                        <img src="/images/editar.png" alt="Editar" class="formato-imagen" />
                                    </button>

                                    <form id="delete-form-{{ $documentacion->id }}" action="{{ url('/documentaciones/' . $documentacion->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="buttons-dentro-tabla" title="Borrar documento" onclick="return confirm ('¿Seguro que quieres borrar este documento?')">
                                            <img src="/images/borrar.png" alt="Borrar" class="formato-imagen" />
                                        </button>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
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
                <span>&nbsp;|&nbsp;</span>
                <a href="{{ url('/') }}">Contactos</a>

            </div>
        </div>
    </section>
</body>
</html>