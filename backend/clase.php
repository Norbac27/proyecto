<?php
require_once 'conexion.php';

class CRUD extends Conexion {
    
    public function registrarse($nombres, $apellidos, $telefono, $id_rol, $correo, $usuario , $contraseña)
    {
        $password_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nombres, apellidos, telefono, id_rol , correo , usuario  , contraseña) VALUES (?, ?, ?, ? , ? , ? , ? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $telefono, $id_rol,  $correo , $usuario , $password_encriptada]);
    }
    public function seleccionarUsuario() 
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function registrarEmpleado($nro_documento , $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion, $fotocopia_documento) 
    {
        $ruta_imagen = "";

        if (isset($fotocopia_documento['name']) && $fotocopia_documento['name']) {
            $ruta_destino = 'imagenes/' . $fotocopia_documento['name'];
            if (move_uploaded_file($fotocopia_documento['tmp_name'], $ruta_destino)) {
                $ruta_imagen = $fotocopia_documento['name'];
            } else {
                die("Error al subir la imagen.");
            }
        }
     
        $sql = "INSERT INTO empleado (nro_documento , tipo_documento, fecha_nacimiento_empleado, nombre1_empleado, nombre2_empleado, apellido1_empleado, apellido2_empleado, correo, telefono, nit_empresa, id_tipo_empleado, id_cargo, fecha_contratacion, salario, id_direccion, fotocopia_documento) VALUES (?, ?, ?, ? , ? , ? , ? , ? , ? , ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento , $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono,$nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion, $ruta_imagen]);
    }
    public function seleccionarEmpleadoPorID($nro_documento) {
        $query = "SELECT * FROM empleado WHERE nro_documento = :nro_documento";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nro_documento', $nro_documento, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarEmpleado($nro_documento , $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion, $ruta_imagen) 
    
    {
        if ($ruta_imagen) {
            $sql = "UPDATE empleado SET  nro_documento = ?, tipo_documento = ?, fecha_nacimiento_empleado = ?, nombre1_empleado = ? , nombre2_empleado = ? , apellido1_empleado = ? , apellido2_empleado = ?, correo = ?, telefono = ?, nit_empresa = ? , id_tipo_empleado = ? , id_cargo  = ? , fecha_contratacion  = ? ,salario  = ? ,id_direccion  = ?, fotocopia_documento= ? WHERE  nro_documento = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([ $nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado,$correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion, $ruta_imagen]);
        } else {

        $sql = "UPDATE empleado SET nro_documento = ?, tipo_documento = ?, fecha_nacimiento_empleado = ?, nombre1_empleado = ? , nombre2_empleado = ? , apellido1_empleado = ? , apellido2_empleado = ? , correo = ?, telefono = ?, nit_empresa = ? , id_tipo_empleado = ? , id_cargo  = ? , fecha_contratacion  = ? ,salario  = ? ,id_direccion  = ? WHERE  nro_documento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([ $nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $id_direccion]);
    }
    }   
    public function eliminarEmpleado($nro_documento) 
    
    {
        $sql = "DELETE FROM empleado WHERE nro_documento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }
    public function seleccionarEmpleado() 
    {
        $sql = "SELECT * FROM empleado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>