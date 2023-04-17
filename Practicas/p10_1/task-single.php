<?php
require_once 'Productos.php';
require_once 'DataBase.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $productos = new Productos('marketzone');
    $productos->single($id);

    echo $productos->getResponse();
}
?>