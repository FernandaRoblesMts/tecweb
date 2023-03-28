<?php
include('database.php');

$search = $_POST['search'];

if(!empty($search)){
  $query = "SELECT * FROM productos Where nombre like '$search%' OR marca LIKE '$search%' OR detalles LIKE '$search%' ";
  $result = mysqli_query($conexion, $query);
  if(!$result){
    die('Query Error'. mysqli_error($conexion));
  }
  $json = array();
  while($row = mysqli_fetch_array($result)){
  $json [] = array(
  'nombre' => $row['nombre'],
  'marca' => $row['marca'],
  'modelo' => $row['modelo'],
  'precio' => $row['precio'],
  'detalles' => $row['detalles'],
  'unidades' => $row['unidades']

  );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>