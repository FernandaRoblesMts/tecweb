<?php
namespace backend\API;

abstract class DataBase {
    protected $conexion;
    protected $response;

    public function __construct($database="marketzone") {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            'f!oJ[_Bb6q8F[FKu',
            $database
        );
    
        /**
         * NOTA: si la conexión falló $conexion contendrá false
         **/
        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
        /*else {
            echo 'Base de datos encontrada';
        }*/

        $this->response = array();
    }

    public function getResponse() {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>