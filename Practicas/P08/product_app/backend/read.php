<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['texto']) ) {
        $texto = $_POST['texto'];

        if ($result = $conexion->query("SELECT * FROM productos WHERE nombre LIKE '%{$texto}%' OR marca LIKE '%{$texto}%' OR detalles LIKE '%{$texto}%'")) {
            // SE OBTIENEN LOS RESULTADOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = array_map('utf8_encode', $row);
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>