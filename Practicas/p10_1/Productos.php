<?php

require_once 'DataBase.php';

class Productos extends DataBase {
    protected $response;
    
    public function __construct($dbName, $response = []) 
    {
        parent::__construct($dbName);
        $this->response = $response;
    }

    public function getResponse() 
    {
        return json_encode($this->response);
    }

    public function list() 
    {
        $query = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $this->conexion->query($query);
    
        if(!$result){
            die('Query failed'. mysqli_error($this->conexion));
        }
        
        $json = [];
        
        while($row = mysqli_fetch_array($result)){
            $json[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'precio' => $row['precio'],
                'detalles' => $row['detalles'],
                'unidades' => $row['unidades'],
            ];
        }
        
        $this->response = $json;
    }
    public function delete($id) {
        $query = "UPDATE productos SET eliminado = 1 WHERE id = $id";

        // $query = "DELETE FROM products WHERE id = $id";
    
        if ($this->conexion->query($query)) {
            $this->response = [
                'status'  => 'success',
                'message' => 'Producto eliminado correctamente'
            ];
        } else {
            $this->response = [
                'status'  => 'error',
                'message' => 'No se pudo eliminar el producto'
            ];
        }
    }
    public function search($search){
        $query = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        $result = $this->conexion->query($query);

        if(!$result){
            die('Query failed'. mysqli_error($this->conexion));
        }
        
        $json = [];
        
        while($row = mysqli_fetch_array($result)){
            $json[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'precio' => $row['precio'],
                'detalles' => $row['detalles'],
                'unidades' => $row['unidades'],
            ];
        }
        
        $this->response = $json;
    }
    
    public function addProduct($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen){

        $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
        
        if ($this->conexion->query($sql)) {
            $this->response = [
                'status'  => 'success',
                'message' => 'Producto agregado correctamente'
            ];
        } else {
            $this->response = [
                'status'  => 'error',
                'message' => 'No se pudo agregar el producto'
            ];
        }
    }

    public function edit($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        $sql_1 = "SELECT * FROM productos WHERE id = '{$id}' and nombre = '{$nombre}' and marca = '{$marca}' and modelo = '{$modelo}' and precio = {$precio} and detalles = '{$detalles}' and unidades = {$unidades} and imagen = '{$imagen}'";
        $res = $this->conexion->query($sql_1);
    
        if ($res->num_rows == 0) {
            $sql = "UPDATE productos SET nombre = '{$nombre}', marca = '{$marca}', modelo = '{$modelo}', precio = {$precio}, detalles = '{$detalles}', unidades = {$unidades}, imagen = '{$imagen}' WHERE id = '{$id}'";
            if($this->conexion->query($sql)){
                $this->response = [
                    'status'  => 'success',
                    'message' => 'Producto actualizado'
                ];
            } else {
                $this->response = [
                    'status'  => 'error',
                    'message' => 'No se pudo actualizar el producto'
                ];
            }
        } else {
            $this->response = [
                'status'  => 'success',
                'message' => 'Los datos son iguales'
            ];
        }
    }

    
    public function single($id) 
    {
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = $this->conexion->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
    
            $this->response = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'precio' => $row['precio'],
                'detalles' => $row['detalles'],
                'unidades' => $row['unidades'],
                'imagen' => $row['imagen']
            ];
        
        } else {
            $this->response = [
                'status' => 'error',
                'message' => mysqli_error($this->conexion)
            ];
        }
    }
}

?>

