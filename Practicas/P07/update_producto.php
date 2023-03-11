<?php
	// Conectar con la base de datos
	$link = mysqli_connect("localhost", "root", "123456", "marketzone");

	// Comprobar la conexión
	if($link === false){
	    die("ERROR: No se pudo conectar con la base de datos. " . mysqli_connect_error());
	}

	// Procesar el envío del formulario
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Recuperar los valores enviados desde el formulario
		$id = $_POST["id"];
		$nombre = $_POST["nombre"];
		$marca = $_POST["marca"];
		$modelo = $_POST["modelo"];
		$precio = $_POST["precio"];
		$detalles = $_POST["detalles"];
		$unidades = $_POST["unidades"];
		$imagen = $_POST["imagen"];

		if (!$link->query("UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', detalles='$detalles', unidades='$unidades', imagen='$imagen' WHERE id='$id'")) {
			echo "Error al actualizar el producto: " . mysqli_error($link);
		}
		 
	$link->close();
}