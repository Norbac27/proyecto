
<?php
    require_once 'clase.php';

    $crud = new CRUD();
    $mensaje = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['id_rol']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['contraseña'])) 
        
        {
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $telefono = $_POST['telefono'];
            $id_rol = $_POST['id_rol'];
            $correo = $_POST['correo'];
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'] ;
            
            $crud->registrarse($nombres, $apellidos, $telefono, $id_rol, $correo, $usuario , $contraseña);

            if ($crud) {
                $mensaje = "Registro exitoso. ¡Por favor, inicia sesión!";
            } else {
                $mensaje = "No se registró. Inténtalo de nuevo.";
            }
        }
    }
    
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: movimientoFondo 10s infinite alternate;
            overflow: hidden;
            background-color:#5874f055;
        }

        video {
            min-width: 100%;
            min-height: 100%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .container {
            background-color:#fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            z-index: 1;

        }

        label{
            font-family: 'Source Sans 3', sans-serif;
        }

        .container input {
            
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            background-color: #5874f055;
            border: none;
            padding: 8px;
            border-radius: 5px;
        }

        input[type="submit"] {
            
            width: 100%;
            padding: 10px;
            background-color: #5874f0;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .container input:focus {
            outline: none;
        }

    </style>
    <title>Registrarse</title>
    
</head>

<body>
<video autoplay muted loop>
        <source src="a.mp4" type="video/mp4">
    </video>
    <div class="container">
        <h2>Registrate</h2>
        <form action="" method="post">
           
            <input type="text" id="nombres" name="nombres" placeholder="Nombre"required><br>
           
            <input type="text" id="apellidos" name="apellidos"placeholder="Apellido" required><br>

           
            <input type="text" id="telefono" name="telefono" placeholder="Telefono"required><br>

            
            <input type="text" id="id_rol " name="id_rol "placeholder="Rol" required><br>

            
            <input type="text" id="correo" name="correo"placeholder="Correo" required><br>

            
            <input type="text" id="usuario" name="usuario" placeholder="Usuario"required><br>

            
            <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña"required pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres y contener al menos un número y una letra">
            <span id="togglePassword"></span>
            
            <label for="label" class="" style="margin-top: 5px;">¿Ya tienes una cuenta? <a href="login.php">Ingresa</a></label>

            <br><br>
            <input type="submit" value="Registrarse">
           
        </form>
        <?php if(isset($mensaje)) { echo "<p>$mensaje</p>"; } ?>
    </div>

</body>
</html>

