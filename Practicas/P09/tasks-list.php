<?php
 include('database.php');

 $query = "SELECT * FROM productos";
 $result = mysqli_query($conexion, $query);

 if(!$result){
    die('Query failed'. mysqli_error($conexion));
 }
 $json = array();
 while($row = mysqli_fetch_array($result)){
    $json[] = array(
  'id' => $row['id'],
  'nombre' => $row['nombre'],
  'marca' => $row['marca'],
  'modelo' => $row['modelo'],
  'precio' => $row['precio'],
  'detalles' => $row['detalles'],
  'unidades' => $row['unidades'],

    );
 }
 $jsonstring = json_encode($json);
 echo $jsonstring;

?>