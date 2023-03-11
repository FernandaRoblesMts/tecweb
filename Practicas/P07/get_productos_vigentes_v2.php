<?php
if(isset($_GET['tope'])) {
    $tope = $_GET['tope'];
} else {
    die('Parámetro "tope" no detectado...');
}

if (!empty($tope)) {
    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', '123456', 'marketzone');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    /** Crear una tabla que no devuelve un conjunto de resultados */
    if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
        /** Se extraen las tuplas obtenidas de la consulta */
        $row = $result->fetch_all(MYSQLI_ASSOC);

        /** Se crea un arreglo con la estructura deseada */
        foreach($row as $num => $registro) {
            foreach($registro as $key => $value) {
                $data[$num][$key] = $value;
            }
        }

        /** útil para liberar memoria asociada a un resultado con demasiada información */
        $result->free();
    }

    $link->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3 class="mt-3 mb-3">Productos</h3>
        
        <?php if (isset($data)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Detalles</th>
                    <th>Unidades</th>
                    <th>Imagen</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $producto) : ?>
                <tr>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['marca'] ?></td>
                    <td><?= $producto['modelo'] ?></td>
                    <td><?= $producto['precio'] ?></td>
                    <td><?= $producto['detalles'] ?></td>
                    <td><?= $producto['unidades'] ?></td>
                    <td><?= $producto['imagen'] ?></td>
                    
                    <td>
                        <a href="formulario_productos_v2.php?id=<?= $producto['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
        
        
    </div>
</body>
</html>