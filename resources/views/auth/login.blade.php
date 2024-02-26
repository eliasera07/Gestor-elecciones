<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
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
            var confirmacion = confirm("¿Estás seguro de registrar esta elección?");
            if (confirmacion) {
                window.location.href = "/elecciones";
            }
        }
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

        .container {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
        width:  90%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }


        button[type="submit2"]{
              background-color: #E30613;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;   
            margin-bottom: 10px; 
        }
        button[type="submit"]{
              background-color:  #003770 ;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;;
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
        .container {
            font-size: 20px;
            margin-bottom: 20px;
           
            
        }

        .btn-cancelar {
            background-color: #E30613;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-iniciar:hover {
            background-color: #0056b3;
        }

        .btn-cancelar:hover {
            background-color: #FF4545;
        }
        .form-container3 {
            margin: 40px auto;
            padding: 20px;
            
        }
                .register-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
            transition: color 0.3s; /* Agrega una transición suave para el cambio de color */
        }

        .register-link:hover {
            color: darkblue; /* Cambia el color del texto al pasar el ratón sobre el enlace */
        }
                .form-title {
            font-weight: bold;
            text-align: center;
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
            @if(auth()->check())
        <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/elecciones') }}">Elecciones</a></li>
            <li><a href="{{ url('/comunicados') }}">Comunicados</a></li>
            <li><a href="{{ url('/documentaciones') }}">Documentación</a></li>
            {{-- <li><a href="#">Acerca de</a></li>
            <li><a href="#">Contactos</a></li> --}}
            <li><a href="#">Ingreso</a></li>
            <img src="/images/img.png"  class="company-logo">
            @endif
        </ul>
        <div class="menu-icon"></div>
    </nav>
    <header></header>
    
    <div class="header">
        <label for=""></label><br><br>
    </div>
   <br><br>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="form-title" style="font-weight: bold;">
    {{ __('Iniciar Sesion') }}
</div>
                    <div style="text-align: center;">
      
        <img src="images/inicio.png" alt="inicio icono" style="width: 25%; height: auto;">
    </div>
 

        

 


                    <div class="form-container3">
                    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico:') }}</label>
    <div class="col-md-6">
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus maxlength="255">
        <br>
        @error('email')
            <span class="invalid-feedback" role="alert" style="color: red; font-size: smaller;">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }}</label>
        <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" maxlength="50">

            @error('password')
                <span class="invalid-feedback" style="color: red; font-size: smaller;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    

   
        </div>
    </div>

<div style="text-align: center;">
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Iniciar Sesión') }}
            </button>
            <button type="button" class="btn btn-cancelar" onclick="window.location.href='/'">
    {{ __('Cancelar') }}
</button>

                                    <br>
                                    <br>
                                   
           
                                    <div>
                                ¿No tienes una cuenta? <span class="register-link" onclick="window.location.href='/registro'"><br>Registrarse</span>
                          </div>

        </div>
    </div>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <br><br>
        <br><br>
        <br><br>

        <br><br>

        <br><br>
        <br><br>

    
        

        <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cancelBtn = document.querySelector('.btn-cancelar');
        const form = document.querySelector('form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        cancelBtn.addEventListener('click', () => {
            form.reset(); // Resetea los valores del formulario
            emailInput.value = ''; // Establece el valor del campo de correo electrónico en blanco
            passwordInput.value = ''; // Establece el valor del campo de contraseña en blanco
        });
    });
</script>


       

<br><br>
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

   

</body>

</html>