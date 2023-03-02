<?php
$nombre = $_POST["nombre_producto"];
$marca = $_POST["marca_producto"];
$modelo = $_POST["modelo_producto"];
$precio = $_POST["precio_producto"];
$detalles = $_POST["descripcion_producto"];
$unidades = $_POST["cantidad_producto"];
$imagen = $_POST["imagen_producto"];


// Crear el objeto de conexión
@$link = new mysqli('localhost', 'root', '123456', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

// Verificar si ya existe un registro con la misma marca y modelo
$sql = "SELECT * FROM productos WHERE marca = ? AND modelo = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("ss",$marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ya existe un registro con la misma marca y modelo
    echo "Error: Ya existe un producto con la misma marca y modelo en la base de datos.";
} else {
    // No existe un registro con la misma marca y modelo, insertar el nuevo producto
    $sql = "INSERT INTO productos VALUES (null,'{$nombre}', '{$marca}', '{$modelo}', '{$precio}', '{$detalles}', '{$unidades}', '{$imagen}', 0)";

// Ejecutar la consulta SQL
if ($link->query($sql) === TRUE) {
echo "El producto se registró correctamente.";
} else {
echo "Error al insertar producto";
}
}

// Cerrar la conexión
$link->close();

?>