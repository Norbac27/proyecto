<?php
require_once 'clase.php';

$crud = new CRUD();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] === 'registrar') {

            $nro_documento = $_POST['nro_documento'];
            $tipo_documento = $_POST['tipo_documento'];
            $fecha_nacimiento_empleado = $_POST['fecha_nacimiento_empleado'];
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
            $fotocopia_documento = $_FILES['fotocopia_documento'];

            if (empty($nro_documento) || empty($nombre1_empleado)) {
                $mensaje = 'Todos los campos son obligatorios';
            } else {
                try {
                    $crud->registrarEmpleado(
                        $nro_documento,
                        $tipo_documento,
                        $fecha_nacimiento_empleado,
                        $nombre1_empleado,
                        $nombre2_empleado,
                        $apellido1_empleado,
                        $apellido2_empleado,
                        $correo,
                        $telefono,
                        $nit_empresa,
                        $id_tipo_empleado,
                        $id_cargo,
                        $fecha_contratacion,
                        $salario,
                        $fotocopia_documento
                    );

                    $mensaje = 'Empleado registrado exitosamente.';
                } catch (Exception $e) {
                    $mensaje = 'Error al registrar el empleado: ' . $e->getMessage();
                }
            }
        } elseif ($_POST['accion'] === 'borrar' && isset($_POST['nro_documento'])) {
            // Borrar empleado
            $nro_documento = $_POST['nro_documento'];
            $crud->eliminarEmpleado($nro_documento);
            $mensaje = 'Empleado eliminado exitosamente.';
        }
    }
}

$empleados = $crud->seleccionarEmpleado();
$empresas = $crud->seleccionarEmpresas();
$tiposEmpleado = $crud->seleccionarTiposEmpleado();
$cargos = $crud->seleccionarCargos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLEADOS</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./estilos/menu.css">
</head>
<body>

    <header>
        <div class="header__superior">
        <h1>MENU</h1>
        </div>

        <div class="container__menu">
            <div class="menu">
                <input type="checkbox" id="check__menu">
                <label for="check__menu" id="label__check">
                    <i class="fas fa-bars icon__menu"></i>
                </label>
                <nav>
                    <ul>
                        <li><a href="menu.php" id="selected"></a></li>
                        <li><a href="usuarios.php">Empleados</a></li>
                        <li><a href="#">Empresa</a></li>
                        <li><a href="#">Soporte</a></li>
                        <li><a href="index.php">Cerrar sesion</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <h2><center>Datos del empleado</center></h2>
    </main>

    <div class="container">
        
        <div class="registrar-usuario">
            <h2>Registro</h2>
            <form method="POST" enctype="multipart/form-data">

    <table class="registro-table">
            <tr>
                <th><label for="nro_documento">Número de documento:</label></th>
                <td><input type="text" id="nro_documento" name="nro_documento" required></td>

                <th><label for="tipo_documento">Tipo de documento:</label></th>
                <td>
                    <select id="tipo_documento" name="tipo_documento" required>
                        <option value="CC">Cedula de ciudadanía</option>
                        <option value="TI">Tarjeta de identidad</option>
                    </select>
                </td>

                <th><label for="fecha_nacimiento_empleado">fecha de nacimiento:</label></th>
                <td><input type="date" id="fecha_nacimiento_empleado" name="fecha_nacimiento_empleado" required></td>

                <th><label for="fotocopia_documento">Fotocopia del documento:</label></th>
                <td colspan="3"><input type="file" id="fotocopia_documento" name="fotocopia_documento" required></td>
            </tr>
            <tr>
                <th><label for="nombre1_empleado">Primer nombre:</label></th>
                <td><input type="text" id="nombre1_empleado" name="nombre1_empleado" required></td>

                <th><label for="nombre2_empleado">Segundo nombre:</label></th>
                <td><input type="text" id="nombre2_empleado" name="nombre2_empleado" required></td>

                <th><label for="apellido1_empleado">Primer apellido:</label></th>
                <td><input type="text" id="apellido1_empleado" name="apellido1_empleado" required></td>

                <th><label for="apellido2_empleado">Primer apellido:</label></th>
                <td><input type="text" id="apellido2_empleado" name="apellido2_empleado" required></td>
            </tr>

            <tr>
                <th><label for="correo">Correo:</label></th>
                <td><input type="text" id="correo" name="correo" required></td>
                
                <th><label for="telefono">Telefono:</label></th>
                <td><input type="text" id="telefono" name="telefono" required></td>

                <th><label for="nit_empresa">Empresa:</label></th>
                <td>
                    <select id="nit_empresa" name="nit_empresa" required>
                        <?php foreach ($empresas as $empresa) : ?>
                            <option value="<?php echo $empresa['nit_empresa']; ?>"><?php echo $empresa['nombre_empresa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        
                <th><label for="id_tipo_empleado">Tipo Vinculacion:</label></th>
                <td>
                    <select id="id_tipo_empleado" name="id_tipo_empleado" required>
                        <?php foreach ($tiposEmpleado as $tipoEmpleado) : ?>
                            <option value="<?php echo $tipoEmpleado['id_tipo_empleado']; ?>"><?php echo $tipoEmpleado['nombre_tipo_empleado']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>    

            <tr>
                <th><label for="id_cargo">Cargo:</label></th>
                <td>
                    <select id="id_cargo" name="id_cargo" required>
                        <?php foreach ($cargos as $cargo) : ?>
                            <option value="<?php echo $cargo['id_cargo']; ?>"><?php echo $cargo['nombre_cargo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>

                <th><label for="fecha_contratacion">Fecha de contratacion:</label></th>
                <td><input type="date" id="fecha_contratacion" name="fecha_contratacion" required></td>

                <th><label for="salario">Salario:</label></th>
                <td><input type="text" id="salario" name="salario" required></td>
                
            </tr>
    </table>
    <br>
    <button type="submit" name="accion" value="registrar">Registrar</button>
    </form>

            <br>
            <h2>Empleados Registrados</h2>
        </div>
        
        <div class="barra-table">
            <table class="datos-table">
            <tr>
                <th>Número de documento</th>
                <th>Tipo de documento</th>
                <th>Fecha de nacimiento</th>
                <th>Primer nombre</th>
                <th>Segundo nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>NIT empresa</th>
                <th>id tipo empleado </th>
                <th>id cargo </th>
                <th>Fecha contratacion</th>
                <th>Salario</th>
                <th>Fotocopia documento</th>
                <th>Acciones</th>
            </tr>
                <?php foreach ($empleados as $empleado) : ?>
                <tr>
                    <td><?php echo $empleado['nro_documento']; ?></td>
                    <td><?php echo $empleado['tipo_documento']; ?></td>
                    <td><?php echo $empleado['fecha_nacimiento_empleado']; ?></td>
                    <td><?php echo $empleado['nombre1_empleado']; ?></td>
                    <td><?php echo $empleado['nombre2_empleado']; ?></td>
                    <td><?php echo $empleado['apellido1_empleado']; ?></td>
                    <td><?php echo $empleado['apellido2_empleado']; ?></td>
                    <td><?php echo $empleado['correo']; ?></td>
                    <td><?php echo $empleado['telefono']; ?></td>
                    <td><?php echo $empleado['nit_empresa']; ?></td>
                    <td><?php echo $empleado['id_tipo_empleado']; ?></td>
                    <td><?php echo $empleado['id_cargo']; ?></td>
                    <td><?php echo $empleado['fecha_contratacion']; ?></td>
                    <td><?php echo $empleado['salario']; ?></td>
                    <td><img class="imagen-usuario" src="imagenes/<?php echo $empleado['fotocopia_documento']; ?>" alt="fotocopia del documento" width="70"></td>
                    <td class="actions">
                        <a class="editar" href="editar.php?nro_documento=<?php echo $empleado['nro_documento']; ?>">Editar</a><br><br>
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="nro_documento" value="<?php echo $empleado['nro_documento']; ?>">
                            <input type="hidden" name="accion" value="borrar">
                            <button class="borrar" type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
        <br><br><a class="imprimir" href="print.php?id=<?php echo $empleado['nro_documento']; ?>">Imprimir</a>
    </div>
</body>
</html>