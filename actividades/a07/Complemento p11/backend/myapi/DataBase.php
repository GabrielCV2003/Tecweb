<?php
namespace MyApi;

abstract class DataBase {
    protected $conexion;

    public function __construct(string $db = 'marketzone', string $user = 'root', string $pass = 'vallelly2003') {
        $this->conexion = new \mysqli('localhost', $user, $pass, $db);

        if ($this->conexion->connect_error) {
            die('¡Base de datos NO conectada! ' . $this->conexion->connect_error);
        }
    }

    public function __destruct() {
        $this->conexion->close();
    }
}
?>
