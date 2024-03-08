<?php
	include 'config/funciones.php';
	comprobar_sesion();
	comprobar_rol_gerente();

	if (isset($_GET['id_producto'])) {
	 $consulta = eliminar($_GET['id_producto']);
	}else{
	 header('Location: producto_listar.php');
	}

	function eliminar($id){
 	require_once 'config/conexion.php';

		$sentencia="DELETE FROM productos WHERE id_producto='".$id."';";
		$conexion->query($sentencia) or die (mysqli_error($conexion));
		header('Location: producto_listar.php');
	}

mysqli_close($conexion); 
?>
