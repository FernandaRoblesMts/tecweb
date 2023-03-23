<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if(!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JASON A OBJETO
    $jsonOBJ = json_decode($producto);

    // VALIDAMOS SI EL PRODUCTO YA EXISTE EN LA BD
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM productos WHERE nombre = :nombre AND eliminado = 0");
    $stmt->bindParam(':nombre', $jsonOBJ->nombre);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        // EL PRODUCTO YA EXISTE, NO SE INSERTA NUEVAMENTE
        echo "Error: El producto ya existe.";
    } else {
        // EL PRODUCTO NO EXISTE, PROCEDER CON LA INSERCIÓN
        $stmt = $conn->prepare("INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (:nombre, :marca, :modelo, :precio, :detalles, :unidades, :imagen)");
        $stmt->bindParam(':nombre', $jsonOBJ->nombre);
        $stmt->bindParam(':marca', $jsonOBJ->marca);
        $stmt->bindParam(':modelo', $jsonOBJ->modelo);
        $stmt->bindParam(':precio', $jsonOBJ->precio);
        $stmt->bindParam(':detalles', $jsonOBJ->detalles);
        $stmt->bindParam(':unidades', $jsonOBJ->unidades);
        $stmt->bindParam(':imagen', $jsonOBJ->imagen);
        $stmt->execute();
        echo "Producto agregado exitosamente.";
    }
} else {
    echo "Error: No se ha enviado ningún producto.";
}
