<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing:border-box;
            font-family: "Uni Sans" , sans-serif;
        }
        nav{
            display:flex;
            align-items: center;
            justify-content: space-around;
            height: 70px;
            background-image: linear-gradient(to right, #003770, #f80211);
            border-bottom: 2px solid #fff;
        }
        nav .logo a {
            font-size:20px;
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
            font: weight 500;
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
    </style>
        
    <script>
            document.addEventListener('DOMContentLoaded', () => {
                const menuIcon = document.querySelector(".menu-icon");
                const navList = document.querySelector("nav ul");  // Cambio aquí
        
                menuIcon.addEventListener('click', () => {
                    menuIcon.classList.toggle("active");
                    navList.classList.toggle("active");
                });
            });
    </script>
        
</head>
<body>
    <nav>
        <div class="logo">
            <div><a href="#">TRIBUNAL ELECTORAL</a></div>
            <div><a href="#">UNIVERSITARIO</a></div>
    </div>
    <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Elecciones</a></li>
        <li><a href="#">Documentación</a></li>
        <li><a href="#">Acerca de</a></li>
        <li><a href="#">Contactos</a></li>
        <li><a href="#">Ingreso</a></li>
    </ul>
    <div class="menu-icon"></div>
    </nav>
    
</body>
</html>