<!DOCTYPE html>
<html>
<head>
	<title>Formulario de Actualizacion de Productos</title>
	<meta charset="UTF-8">
</head>
<body>
	<h1>Actualizacion de Productos</h1>
<form action="update_producto.php" method="POST" onsubmit="return validarFormulario()">
<label for="id">ID del Producto a Modificar:</label>
<input type="text" id="id" name="id" ><br><br><br><br>
	<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" required maxlength="100"><br><br>
<label for="marca">Marca:</label>
<select type="text" id="marca" name="marca" required>
<option value="">Seleccionar</option>
        <option value="Gamesa">Gamesa</option>
        <option value="Marinela">Marinela</option>
        <option value="Bimbo">Bimbo</option>
        <option value="Saritas">Sabritas</option>
        <option value="Barcel">Barcel</option>
</select><br><br>
<label for="modelo">Modelo:</label>
<input type="text" id="modelo" name="modelo" required maxlength="25"><br><br>
<label for="precio">Precio:</label>
<input type="number" id="precio" name="precio" required min="100" step="0.01"><br><br>
<label for="detalles">Detalles:</label>
<textarea id="detalles" name="detalles" maxlength="250"></textarea><br><br>
<label for="unidades">Unidades:</label>
<input type="number" id="unidades" name="unidades" required min="0"><br><br>
<label for="imagen">Imagen:</label>
<input type="text" id="imagen" name="imagen"><br><br>
	
<input type="submit" value="Actualizar">
<br>
<script>
  function validarFormulario() {
	var nombre = document.getElementById("nombre").value;
	var marca = document.getElementById("marca").value;
	var modelo = document.getElementById("modelo").value;
	var precio = document.getElementById("precio").value;
	var detalles = document.getElementById("detalles").value;
	var unidades = document.getElementById("unidades").value;
	var imagen = document.getElementById("imagen");
	var errores = "";
	if (nombre.length === 0 || nombre.length > 100) {
	  alert("El nombre debe tener entre 1 y 100 caracteres.");
	  return false;
	}
	if (marca === "") {
	  alert("Debe seleccionar una marca.");
	  return false;
	}
	if (modelo.length === 0 || modelo.length > 25) {
	  alert("El modelo debe tener entre 1 y 25 caracteres.");
	  return false;
	}
	if (precio <= 99.99) {
	  alert("El precio debe ser mayor a 99.99.");
	  return false;
	}
	if (detalles.length > 250) {
	  alert("Los detalles no pueden tener más de 250 caracteres.");
	  return false;
	}
	if (unidades < 0) {
	  alert("Las unidades no pueden ser negativas.");
	  return false;
	}
	imagen.defaultValue = "img/img.jpg";
	return true;
  }
</script>
</body>
</html> 