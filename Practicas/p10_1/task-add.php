<?php
require_once 'Productos.php';
require_once 'Database.php';

$producto = file_get_contents('php://input');

if(!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JASON A OBJETO
    $jsonOBJ = json_decode($producto);

    $productos = new Productos('marketzone');

    
    $nombre = $jsonOBJ->nombre;
    $marca = $jsonOBJ->marca;
    $modelo = $jsonOBJ->modelo;
    $precio = $jsonOBJ->precio;
    $detalles = $jsonOBJ->detalles;
    $unidades = $jsonOBJ->unidades;
    $imagen = $jsonOBJ->imagen;

    // Llama al método "list" de la instancia "productos" y obtiene la respuesta
    $productos->addProduct($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
    $respuesta = $productos->getResponse();
    
    // Imprime la respuesta en formato JSON
    echo $respuesta;
}



?>