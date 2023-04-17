<?php
require_once 'Productos.php';
require_once 'Database.php';

$productos = new Productos('marketzone');

$search = $_GET['search'];
// Llama al método "list" de la instancia "productos" y obtiene la respuesta
$productos->search($search);
$respuesta = $productos->getResponse();

// Imprime la respuesta en formato JSON
echo $respuesta;

?>