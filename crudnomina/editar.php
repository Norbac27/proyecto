<!DOCTYPE html>
<html>
<head>
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="estilos/editar.css"> 
</head>
<body>
    <?php
    require_once 'clase.php';

    $crud = new CRUD();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nro_documento']) && isset($_POST['tipo_documento']) && isset($_POST['fecha_nacimiento_empleado']) && isset($_POST['nombre1_empleado']) && isset($_POST['nombre2_empleado']) && isset($_POST['apellido1_empleado']) && isset($_POST['apellido2_empleado']) && isset($_POST['correo']) && isset($_POST['telefono'])  && isset($_POST['nit_empresa'])  && isset($_POST['id_tipo_empleado']) && isset($_POST['id_cargo']) && isset($_POST['fecha_contratacion']) && isset($_POST['salario'])  && isset($_POST['id_direccion'])  && isset($_FILES['fotocopia_documento'])) {
        
            $nro_documento = $_POST['nro_documento'];
            $tipo_documento = $_POST['tipo_documento'];
            $fecha_nacimiento_empleado = $_POST["fecha_nacimiento_empleado"];
            $nombre1_empleado = $_POST['nombre1_empleado'];
            $nombre2_empleado = $_POST['nombre2_empleado'];
            $apellido1_empleado = $_POST['apellido1_empleado'];
            $apellido2_empleado = $_POST['apellido2_empleado'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $nit_empresa = $_POST['nit_empresa'];
            $id_tipo_empleado = $_POST['id_tipo_empleado'];
            $id_cargo = $_POST['id_cargo'];
            $fecha_contratacion = $_POST['fecha_contratacion'];
            $salario = $_POST['salario'];
            $id_direccion = $_POST['id_direccion'];
            $fotocopia_documento = $_FILES['fotocopia_documento'];
         
            
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != '') {
                $imagen_name = $_FILES['imagen']['name'];
                $imagen_temp = $_FILES['imagen']['tmp_name'];
                $imagen_destino = "imagenes/" . $imagen_name;

                if (move_uploaded_file($imagen_temp, $imagen_destino)) {
                    $ruta_imagen = $imagen_name;
                } else {
                    echo "Error al subir la imagen.";
                }
            } else {
                $ruta_imagen = $_POST['imagen_actual'];
            }

            $crud->actualizarEmpleado($nro_documento , $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion, $ruta_imagen);
            
            header("Location: usuarios.php");
            exit(); // 
        }
    }

    if (isset($_GET['nro_documento'])) {
        $idUsuario = $_GET['nro_documento'];
        $usuario = $crud->seleccionarEmpleadoPorID($idUsuario);
    }
    ?>

    <div class="container">
        <div class="registrar-usuario">
        <h1>Editar</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="nro_documento" value="<?php echo $usuario['nro_documento']; ?>">

            <label for="tipo_documento">Tipo de documento:</label>
            <select id="tipo_documento" name="tipo_documento" value="<?php echo $usuario['tipo_documento']; ?>" required>
                <option value="CC">Cedula de ciudadania</option>
                <option value="TI">Tarjeta de identidad</option>
            </select><br>

            <label for="fecha_nacimiento_empleado">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento_empleado" name="fecha_nacimiento_empleado" value="<?php echo $usuario['fecha_nacimiento_empleado']; ?>" required>

            <label for="nombre1_empleado">nombre:</label>
            <input type="text" id="nombre1_empleado" name="nombre1_empleado" value="<?php echo $usuario['nombre1_empleado']; ?>" required>

            <label for="nombre2_empleado">nombre:</label>
            <input type="text" id="nombre2_empleado" name="nombre2_empleado" value="<?php echo $usuario['nombre2_empleado']; ?>" required>

            <label for="apellido1_empleado">apellidos:</label>
            <input type="text" id="apellido1_empleado" name="apellido1_empleado" value="<?php echo $usuario['apellido1_empleado']; ?>" required>

            <label for="apellido2_empleado">apellidos:</label>
            <input type="text" id="apellido2_empleado" name="apellido2_empleado" value="<?php echo $usuario['apellido2_empleado']; ?>" required>
           
            <label for="correo">correo:</label>
            <input type="text" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>
            
            <label for="telefono">telefono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" required>
            
            <label for="nit_empresa">nit_empresa:</label>
            <input type="text" id="nit_empresa" name="nit_empresa" value="<?php echo $usuario['nit_empresa']; ?>" required>
            
            <label for="id_tipo_empleado">id_tipo_empleado:</label>
            <input type="text" id="id_tipo_empleado" name="id_tipo_empleado" value="<?php echo $usuario['id_tipo_empleado']; ?>" required>
            
            <label for="id_cargo">id_cargo:</label>
            <input type="text" id="id_cargo" name="id_cargo" value="<?php echo $usuario['id_cargo']; ?>" required>
            
            <label for="fecha_contratacion">fecha_contratacion:</label>
            <input type="date" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo $usuario['fecha_contratacion']; ?>" required>
            
            <label for="salario">salario:</label>
            <input type="text" id="salario" name="salario" value="<?php echo $usuario['salario']; ?>" required>
            
            <label for="id_direccion">id_direccion:</label>
            <input type="text" id="id_direccion" name="id_direccion" value="<?php echo $usuario['id_direccion']; ?>" required>
            

            <label for="imagen">Imagen del usuario:</label>
                <input type="file" id="imagen" name="imagen">

                <input type="hidden" name="imagen_actual" value="<?php echo $usuario['fotocopia_documento']; ?>">

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>