<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
	if(isset($_GET['tope']))
		$tope = $_GET['tope'];
if (!empty($tope))
{
	/** SE CREA EL OBJETO DE CONEXION */
	@$link = new mysqli('localhost', 'root', '123456', 'marketzone');	

	/** comprobar la conexión */
	if ($link->connect_errno) 
	{
		die('Falló la conexión: '.$link->connect_error.'<br/>');
		    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
	}

	/** Crear una tabla que no devuelve un conjunto de resultados */
	if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= '{$tope}'") ) 
	{
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		/** útil para liberar memoria asociada a un resultado con demasiada información */
		$result->free();
	}

	$link->close();
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Productos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h3>PRODUCTOS</h3>

	<br/>
	
	<?php if( isset($rows) ) : ?>

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
  <?php foreach ($rows as $producto): ?>
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
En este ejemplo, se agrega una nueva columna al final de la tabla con un enlace que redirige al formulario de edición del producto correspondiente. El enlace incluye el ID del producto como un parámetro GET en la URL para poder identificar el producto que se desea editar.







	<?php elseif(!empty($tope)) : ?>

		 <script>
            alert('No hay productos con una cantidad de unidades menor o igual al tope especificado');
         </script>

	<?php endif; ?>
</body>
</html>