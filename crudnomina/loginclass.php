<?php

require_once 'conexion.php';

class LoginController
{
    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->login();
        }
    }

    public function login()
    {
        $user = $_POST['usuario'];
        $contrasena = $_POST['contraseña'];

        try {
            $db = new Conexion();
            $pdo = $db->getPdo();

            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = ?");
            $stmt->execute([$user]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($contrasena, $usuario['contraseña'])) {
                $_SESSION['username'] = $user;
                echo "Inicio de sesión exitoso. Redirigiendo...";
                header('Location: menu.php');
                exit();
            } else {
                echo "Credenciales incorrectas. Inténtalo de nuevo.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$loginController = new LoginController();

?>

