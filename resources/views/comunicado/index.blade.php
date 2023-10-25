
<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <br>
    <br>
    <br>
    <title>Comunicados</title>
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
            <li><a href="#">Documentación</a></li>
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>

    <section class="fondoo" id="fondoo">
        
        <br>
        <br>
        <br>
        <center>
            <h1>Comunicados</h1>
        </center>
        <br>
        <br>

        <div class="container botonesss">
            <div class="botones">
                <a href="{{ url('comunicados/create') }}" class="buttons">Añadir</a>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table id="eleccionesTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Titulo</th>
                                <th>Añadido el:</th>
                                <th>Finaliza el:</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comunicados as $comunicado)
                                <tr>
                                    <td>{{ $comunicado->id}}</td>
                                    <td>{{ $comunicado->titulo}}
                                    <td>
                                        @if ($comunicado->inicio)
                                            {{ \Carbon\Carbon::parse($comunicado->inicio)->format('d/m/y') }}
                                        @else
                                            Sin fecha
                                        @endif
                                    </td>
                                    <td>
                                        @if ($comunicado->fin)
                                            {{ \Carbon\Carbon::parse($comunicado->fin)->format('d/m/y') }}
                                        @else
                                            Sin fecha de fin
                                        @endif
                                    </td>

                                    <td class="celda-botones">
                                    <button class="buttons-dentro-tabla" title="Editar Comite" onclick="window.location.href='{{ url('/comunicados/' . $comunicado->id . '/edit') }}'">
                                        <img src="/images/editar.png" alt="Editar" class="formato-imagen" />
                                    </button>

                                    <form id="delete-form-{{ $comunicado->id }}" action="{{ url('/comunicados/' . $comunicado->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button class="buttons-dentro-tabla" title="Borrar Elección" onclick="return confirm ('¿Seguro que quieres borrar este comunicado?')">
                                            <img src="/images/borrar.png" alt="Borrar" class="formato-imagen" />
                                        </button>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <!--{{ $comunicados->links() }}-->
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