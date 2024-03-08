<?php
try {
	$conexion = new mysqli("localhost", "root", "root", "vogue_db");
	$conexion->set_charset("utf8");

} catch (Exception $e) {

	if(mysqli_connect_errno())
	{
		echo "Fallo la conexion | +info: " . $e;
	}
	
}

date_default_timezone_set('America/El_Salvador');
?>