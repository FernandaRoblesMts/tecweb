<?php
require_once 'Productos.php';
require_once 'DataBase.php';

// Crea una instancia de la clase Productos
$productos = new Productos('marketzone');

// Llama al método "list" de la instancia "productos" y obtiene la respuesta
$productos->list();
$respuesta = $productos->getResponse();

// Imprime la respuesta en formato JSON
echo $respuesta;
?>

