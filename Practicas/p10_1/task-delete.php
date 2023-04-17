<?php
require_once 'Productos.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $producto = new Productos('marketzone');
        $producto->delete($id);
        echo $producto->getResponse();
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode([
            'status' => 'error',
            'message' => 'Se requiere el ID del producto a eliminar'
        ]);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode([
        'status' => 'error',
        'message' => 'Método de solicitud no permitido'
    ]);
}
?>
