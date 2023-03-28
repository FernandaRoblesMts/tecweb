<?php

include_once _DIR_ . '/database.php';
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'No es posible actualizar'
);

if (isset($producto)) {

    $jsonOBJ = json_decode($producto);
    $sql_1 = "SELECT * FROM products WHERE nombre = '{$jsonOBJ->nombre}' and marca = '{$jsonOBJ->marca}' and modelo = '{$jsonOBJ->modelo}' and precio = {$jsonOBJ->precio} and detalles = '{$jsonOBJ->detalles}' and unidades = {$jsonOBJ->unidades} and imagen = '{$jsonOBJ->imagen}'";

    $res = $conexion->query($sql_1);
    if(empty($jsonOBJ->marca)){
        $data['message'] = "ERROR: marca " . mysqli_error($conexion);
    }else if ($res->num_rows == 0) {
        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "UPDATE products SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}'";
        $result = $conexion->query($sql);

        $conexion->set_charset("utf8");
        if ($conexion->query($sql)) {
            $data['status'] =  "success";
            $data['message'] =  "Producto actualizado";
        } else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
    } else {
        $data['status'] =  "success";
        $data['message'] =  "No se ha realizado ninguna actualizacion, los datos son los mismos";
    }


    //$result->free();
    // Cierra la conexion
    $conexion->close();

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
}

?>