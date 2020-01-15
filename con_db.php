<?php
	$conex = new mysqli('localhost', 'root', '', 'registrosKL');
	$conex -> set_charset("utf8");

	if($conex->connect_error){

		die('Error en la conexion' . $conex->connect_error);
	}
?>
