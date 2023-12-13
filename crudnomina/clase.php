<?php
require_once 'conexion.php';

class CRUD extends Conexion {

    public function seleccionarCargos()
    {
        try {
            $consulta = "SELECT * FROM cargo";
            $resultado = $this->pdo->query($consulta);

            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al seleccionar cargos: " . $e->getMessage());
        }
    }

    public function seleccionarTiposEmpleado()
    {
        try {
            $consulta = "SELECT * FROM tipoempleado";
            $resultado = $this->pdo->query($consulta);

            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al seleccionar tipos de empleado: " . $e->getMessage());
        }
    }

    public function seleccionarEmpresas()
    {
        try {
            $consulta = "SELECT * FROM empresa";
            $resultado = $this->pdo->query($consulta);

            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al seleccionar empresas: " . $e->getMessage());
        }
    }


    public function registrarse($nombres, $apellidos, $telefono, $rol, $correo, $usuario , $contraseña)
    {
        $password_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nombres, apellidos, telefono, rol , correo , usuario  , contraseña) VALUES (?, ?, ?, ? , ? , ? , ? )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombres, $apellidos, $telefono, $rol,  $correo , $usuario , $password_encriptada]);
    }

    public function seleccionarUsuario() 
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function registrarEmpleado($nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado, $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa, $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $fotocopia_documento)
    {
        $ruta_imagen = "";

        // Verificar si se proporcionó un archivo y si no hubo errores
        if (isset($fotocopia_documento['name']) && $fotocopia_documento['error'] === UPLOAD_ERR_OK) {
            $ruta_destino = 'imagenes/' . basename($fotocopia_documento['name']);

            // Mover el archivo al directorio de destino
            if (move_uploaded_file($fotocopia_documento['tmp_name'], $ruta_destino)) {
                $ruta_imagen = basename($fotocopia_documento['name']);
            } else {
                die("Error al subir la imagen.");
            }
        }

        try {
            $sql = "INSERT INTO empleado (nro_documento, tipo_documento, fecha_nacimiento_empleado, nombre1_empleado, nombre2_empleado, apellido1_empleado, apellido2_empleado, correo, telefono, nit_empresa, id_tipo_empleado, id_cargo, fecha_contratacion, salario, fotocopia_documento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                $nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado, $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa, $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $ruta_imagen
            ]);

            $empleado_id = $this->pdo->lastInsertId();
            return $empleado_id;
        } catch (PDOException $e) {
            die("Error al registrar el empleado: " . $e->getMessage());
        }
    }

    public function seleccionarEmpleadoPorID($nro_documento) {
        $query = "SELECT * FROM empleado WHERE nro_documento = :nro_documento";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nro_documento', $nro_documento, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarEmpleado($nro_documento , $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $ruta_imagen) 
    
    {
        if ($ruta_imagen) {
            $sql = "UPDATE empleado SET  nro_documento = ?, tipo_documento = ?, fecha_nacimiento_empleado = ?, nombre1_empleado = ? , nombre2_empleado = ? , apellido1_empleado = ? , apellido2_empleado = ?, correo = ?, telefono = ?, nit_empresa = ? , id_tipo_empleado = ? , id_cargo  = ? , fecha_contratacion  = ? ,salario  = ? ,id_direccion  = ?, fotocopia_documento= ? WHERE  nro_documento = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([ $nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado,$correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario, $ruta_imagen]);
        } else {

        $sql = "UPDATE empleado SET nro_documento = ?, tipo_documento = ?, fecha_nacimiento_empleado = ?, nombre1_empleado = ? , nombre2_empleado = ? , apellido1_empleado = ? , apellido2_empleado = ? , correo = ?, telefono = ?, nit_empresa = ? , id_tipo_empleado = ? , id_cargo  = ? , fecha_contratacion  = ? ,salario  = ? ,id_direccion  = ? WHERE  nro_documento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([ $nro_documento, $tipo_documento, $fecha_nacimiento_empleado, $nombre1_empleado, $nombre2_empleado , $apellido1_empleado, $apellido2_empleado, $correo, $telefono, $nit_empresa , $id_tipo_empleado, $id_cargo, $fecha_contratacion, $salario,]);
    }
    }   
    public function eliminarEmpleado($nro_documento) {
        $this->eliminarCuentasBancarias($nro_documento);
        $this->eliminarFamiliares($nro_documento);
        $this->eliminarNovedades($nro_documento);
        $this->eliminarPagosDevengados($nro_documento);
        $this->eliminarPrestaciones($nro_documento);
        $this->eliminarSeguridadSocial($nro_documento);
        
        $sql = "DELETE FROM empleado WHERE nro_documento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }
    
    public function eliminarCuentasBancarias($nro_documento) {
        $sql = "DELETE FROM cuentabancaria WHERE nro_documento_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }

    public function eliminarFamiliares($nro_documento) {
        $sql = "DELETE FROM familiar WHERE nro_documento_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }

    public function eliminarNovedades($nro_documento) {
        $sql = "DELETE FROM novedad WHERE nro_documento_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }
    
    public function eliminarPagosDevengados($nro_documento) {
        $sql = "DELETE FROM pagodevengado WHERE nro_documento_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }
    
    public function eliminarPrestaciones($nro_documento) {
        $sql = "DELETE FROM prestaciones WHERE nro_documento_empleado = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nro_documento]);
    }
    
    public function eliminarSeguridadSocial($nro_documento) {
        $sql = "DELETE FROM seguridadesocial WHERE nro_documento_empleado = ?";
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