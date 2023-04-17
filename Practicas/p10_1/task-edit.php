<?php
require_once 'Productos.php';
require_once 'Database.php';

$task = file_get_contents('php://input');

if (isset($task)) {
    $jsonOBJ = json_decode($task);
    $productos = new Productos('marketzone');
    $productos->edit($jsonOBJ->id,$jsonOBJ->nombre,$jsonOBJ->marca,$jsonOBJ->modelo,$jsonOBJ->precio,$jsonOBJ->detalles,$jsonOBJ->unidades,$jsonOBJ->imagen
    );
    echo $productos->getResponse();
}
?>