<?php
class Conexion {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nomina";
    private $charset = 'utf8';
    public $pdo;

    public function __construct($host = null, $username = null, $password = null, $database = null, $charset = 'utf8') {
        if ($host) {
            $this->host = $host;
        }
        if ($username) {
            $this->username = $username;
        }
        if ($password) {
            $this->password = $password;
        }
        if ($database) {
            $this->database = $database;
        }
        $this->charset = $charset;

        $this->connect();
    }

    public function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";
        
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>
