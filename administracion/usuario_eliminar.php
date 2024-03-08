<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

	if (isset($_GET['id_usuario'])) {
	 $consulta = eliminar($_GET['id_usuario']);
	}else{
	 header('Location: usuario_listar.php');
	}

	function eliminar($id){
 	require_once 'config/conexion.php';

		$sentencia="DELETE FROM usuarios WHERE id_usuario='".$id."';";
		$conexion->query($sentencia) or die (mysqli_error($conexion));
		header('Location: usuario_listar.php');
	}

mysqli_close($conexion);
?>
