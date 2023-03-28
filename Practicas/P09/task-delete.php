<?php
include('database.php');
if(isset($_POST['id'])){
$id = $_POST['id'];
$query = "DELETE FROM producots where id = $id";
$result = mysqli_query($conexion,$query);
if(!$result){
    die('Query failed.');
}
echo "Producto Borrado Correctamente";
}
?>
<?php
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "DELETE FROM productos WHERE id = $id";
    $result = mysqli_query($conexion,$query);
    if(!$result){
        die('Query failed.');
    }
    echo "Producto Borrado Correctamente";
}
?>