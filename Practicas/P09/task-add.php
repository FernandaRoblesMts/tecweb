<?php
include('database.php');

$task = file_get_contents('php://input');
$jsonOBJ = json_decode($task);

// Validar que se recibió un nombre
if (empty($jsonOBJ->nombre)) {
  $response = array(
    'status' => 'error',
    'message' => 'Ingrese un nombre'
  );
  echo json_encode($response);
  exit();
}

// Validar que no exista un producto con el mismo nombre
$sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
  $response = array(
    'status' => 'error',
    'message' => 'Ya existe un producto con ese nombre'
  );
  echo json_encode($response);
  exit();
}

if (empty($jsonOBJ->nombre)){
  $data['message'] = "ERROR: El nombre no puede estar vacío. " . mysqli_error($conexion);
}else

// Insertar el nuevo producto en la base de datos
$conexion->set_charset("utf8");
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";

if ($conexion->query($sql)) {
$response = array(
'status' => 'success',
'message' => 'Producto agregado'
);
} else {
$response = array(
'status' => 'error',
'message' => 'No se pudo agregar el producto: ' . mysqli_error($conexion)
);
}

echo json_encode($response);
$conexion->close();