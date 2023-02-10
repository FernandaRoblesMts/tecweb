<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro Completado</title>
		<style type="text/css">
			body {margin: 20px; 
			background-color: #C4DF9B;
			font-family: Verdana, Helvetica, sans-serif;
			font-size: 90%;}
			h1 {color: #005825;
			border-bottom: 1px solid #005825;}
			h2 {font-size: 1.2em;
			color: #4A0048;}
		</style>
	</head>
	<body>
		<h1>RESPUESTA</h1>

		<?php
           $edad = $_POST["edad"]; 
		   echo "Tu edad: $edad<p>"; 
		   $sexo = $_POST["sexo"];
		   echo "Tu sexo: $sexo<p>";
		   
		   if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
			echo "Bienvenida, usted está en el rango de edad permitido.";
		} else {
			echo "No cumples con los requisitos";
		}
        ?>
	</body>
</html>