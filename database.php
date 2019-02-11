<?php
	// Credenciais base de datos
	$servername = "localhost";
	$username = "alan";
	$password = "turing";
	$database = "ENIGMA";
	// Crear conexion MySQL
	$conn = mysqli_connect($servername, $username, $password, $database);
	// Comprobar conexion, se falla mostrar erro
	if (!$conn) {
		die('<p>Fallou a conexion coa base de datos: </p>' . mysqli_connect_error());
	}
?>
