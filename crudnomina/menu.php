//<?php
//session_start();

//if (!isset($_SESSION['usuario'])) {
    //header("Location: login.php");
    //exit();
//}
//?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <link rel="stylesheet" type="text/css" href="estilos/menu.css"> 
    
   
   
</head>
<header>
    <div class="header__superior">
    <h1>MENU</h1>
    </div>

    <div class="container__menu">
        <div class="menu">
            <input type="checkbox" id="check__menu">
            <label for="check__menu" id="label__check">
                <i class="fas fa-bars icon_menu"></i>
            </label>
            
            <nav>
                <ul>
                    <li><a href="menu.php" id="selected"></a></li>
                    <li><a href="usuarios.php">Empleados</a></li>
                    <li><a href="#">Empresa</a></li>
                    <li><a href="#">Soporte</a></li>
                    <li><a href="index.php">Cerrar sesion</a></li>
                </ul>
            </nav><br><br><br>

            <div class="container">
                <h1><center>Bienvenido al Menú Principal</center></h1>
                <p><center>¡Hola!</center></p>
            </div>
        </div>
    </div>
</header>  
</html>