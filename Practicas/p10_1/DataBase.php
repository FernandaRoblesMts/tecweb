<?php

abstract class DataBase {
    protected $conexion;
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = 'f!oJ[_Bb6q8F[FKu';
    protected $database;

    public function __construct($database) {
        $this->database = $database;
        $this->conectar();
    }

    protected function conectar() {
        $this->conexion = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->conexion) {
            die('¡La base de datos no está conectada!');
        }
    }


    public function desconectar() {
        mysqli_close($this->conexion);
    }
}

?>

