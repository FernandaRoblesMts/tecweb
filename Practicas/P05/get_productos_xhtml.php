<?php
header("Content-Type: application/xhtml+xml; charset=utf-8");

if (isset($_GET['tope'])) {
    $tope = $_GET['tope'];
} else {
    die('Parámetro "tope" no detectado...');
}

if (!empty($tope)) {
    // SE CREA EL OBJETO DE CONEXIÓN
    @$link = new mysqli('localhost', 'root', '123456', 'marketzone');
    // NOTA: con @ se suprime el Warning para gestionar el error por medio de código

    // COMPROBAR LA CONEXIÓN
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    // OBTENER LOS PRODUCTOS CON UNIDADES MENORES O IGUALES A $tope
    $query = "SELECT * FROM productos WHERE unidades <= $tope";
    $result = $link->query($query);

    // CREAR UN DOCUMENTO XHTML CON LOS DATOS OBTENIDOS
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head><title>Productos con unidades menores o iguales a '.$tope.'</title></head>';
    echo '<body>';
    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Detalles</th><th>Precio</th><th>Unidades</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>'.$row['id'].'</td><td>'.$row['nombre'].'</td><td>'.$row['marca'].'</td><td>'.$row['modelo'].'</td><td>'.$row['detalles'].'</td><td>'.$row['precio'].'</td><td>'.$row['unidades'].'</td></tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</body>';
    echo '</html>';

    // LIBERAR LA MEMORIA ASOCIADA AL RESULTADO
    $result->free();

    // CERRAR LA CONEXIÓN
    $link->close();
}
?>