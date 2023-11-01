{{-- mostrar lista de elecciones --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <br>
    <br>
    <br>
    <title>Lista de Elecciones Creadas</title>
    <link rel="stylesheet" href="{{ asset('css/Elecciones_Creadas.css') }}">
    <script src="{{ asset('js/Elecciones_Creadas.js') }}"></script>

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
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="{{ url('/comunicados') }}">Comunicados</a></li>
            <li><a href="#">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contacto</a></li> --}}
            <li><a href="#">Ingreso</a></li>
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <header>



        {{-- <div class="back">
            <div class="menu container">



                <a href="#" class="logo">
                    <img src="images/Logo_TE.png" alt="Logo de la Empresa" class="company-logo">
                    Administrador de Elecciones
                    <br>
                    Universidad Mayor de San Simon

                </a>
                <input type="checkbox" id="menu" />
                <label for="menu">
                    <img src="images/menu.png" class="menu-icono" alt="">
                </label>
                <nav class="navbar">
                    <ul>
                        <li><a href="#">Salir</a></li>
                        
                        <li class="icon-list">
                            <a href="#" class="admin-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <span class="admin-text">Administrador</span>
                            </a>
                        </li>
                        
                        


                    </ul>
                </nav>
            </div>
        </div> --}}
    </header>


    <section class="fondoo" id="fondoo">
        <br>
        <br>
        <br>
        <center>
            <h1>Lista de Elecciones Creadas</h1>
        </center>
        <br>
        <br>

        <div class="container botonesss">
            <div class="botones">
                <a href="{{ route('elecciones.create') }}" class="buttons">Crear nueva elección</a>
            </div>

            <div class="botones">
                <a href="{{ url('/votante') }}" class="buttons">Lista de votantes</a>
            </div>

            <div class="botones">
                <a href="{{ url('/comite') }}" class="buttons">Lista Comité Electoral</a>
            </div>

            <div class="botones">
                <a href="{{ url('/frente') }}" class="buttons">Lista de Frentes</a>
            </div>

            <div class="botones">
                <a href="{{ url('/mesas') }}" class="buttons">Lista de Mesas</a>
            </div>


            <div class="botones">
                <input type="text" id="search" placeholder="Buscar...">
                <button class="buttons" onclick="search()">Buscar</button>
            </div>
        </div>


        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table id="eleccionesTable" class="vistatabla">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Nombre de elección</th>
                                <th>Cargo de Autoridad</th>
                                <th>Gestion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eleccionescreadas as $elecciones)
                                <tr>
                                    <td>{{ $elecciones->id }}</td>
                                    <td>{{ $elecciones->nombre }}</td>
                                    <td>{{ $elecciones->cargodeautoridad }}</td>
                                    <td>{{ $elecciones->gestioninicio }} - {{ $elecciones->gestionfin }}</td>
                                    

                                    <td class="celda-botones">

                                    <a href="{{ route('elecciones.boleta', ['id' => $elecciones->id]) }}" class="buttons" style="background-color: #04243C; color: #FFF; padding: 5px 10px; border: none; cursor: pointer;">Imprimir Boleta</a>


                                        <button class="buttons-dentro-tabla" title="Editar Elección"
                                            onclick="window.location.href='{{ url('/elecciones/' . $elecciones->id . '/edit') }}'">
                                            <img src="/images/editar.png" alt="Editar" class="formato-imagen" />
                                        </button>

                                        <button class="buttons-dentro-tabla" title="Archivar Elección"
                                            onclick="confirmArchivar('{{ url('/elecciones/' . $elecciones->id . '/archivar') }}')">
                                            <img src="/images/archivar.png" alt="Archivar" class="formato-imagen" />
                                        </button>

                                        <button class="buttons-dentro-tabla" title="Añadir Votante"
                                            onclick="window.location.href='{{ url('/votante' . '/create') }}'">
                                            <img src="/images/anadirvotante.png" alt="Archivar"
                                                class="formato-imagen" />
                                        </button>

                                        <button class="buttons-dentro-tabla" title="Añadir Comite"
                                            onclick="window.location.href='{{ url('/comite' . '/create') }}'">
                                            <img src="/images/anadircomite.png" alt="Archivar" class="formato-imagen" />
                                        </button>

                                        {{-- Inicio Función borrar --}}
                                           <form id="delete-form-{{ $elecciones->id }}" action="{{ url('/elecciones/' . $elecciones->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                           <button class="buttons-dentro-tabla" title="Borrar Elección" onclick="return confirm ('Quieres borrar este votante?')">
                                           <img src="/images/borrar.png" alt="Borrar" class="formato-imagen" />
                                           </button>
                                            </form>
                                        {{-- Fin función borrar --}}

                                    </td>

                                    <script>
                                        function confirmArchivar(archivarUrl) {
                                            // Mostrar un cuadro de diálogo de confirmación
                                            var confirmacion = confirm("¿Estás seguro de que deseas archivar esta elección?");

                                            // Si el usuario hace clic en "Aceptar" en el cuadro de diálogo de confirmación
                                            if (confirmacion) {
                                                // Redirigir a la URL de archivar
                                                window.location.href = archivarUrl;
                                            } else {
                                                // No se hace nada si el usuario hace clic en "Cancelar"
                                            }
                                        }
                                    </script>

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

                                            Copyright © 2023 Tribunal Electoral Universitario Todos los derechos
                                            Reservados

                                        </div>
                                        <div class="footer-der">
                                            <a href="{{ url('/') }}">Acerca de</a>
                                            <span>&nbsp;|&nbsp;</span> <!-- Para agregar un separador -->
                                            <a href="{{ url('/') }}">Contactos</a>

                                        </div>

                                    </div>






                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
