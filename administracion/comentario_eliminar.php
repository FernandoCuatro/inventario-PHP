<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();	

	if (isset($_GET['id_comentario'])) {
	 $consulta = eliminar($_GET['id_comentario']);
	}else{
	 header('Location: comentario_listar.php');
	}

	function eliminar($id){
 	require_once 'config/conexion.php';

		$sentencia="DELETE FROM comentarios WHERE id_comentarios='".$id."';";
		$conexion->query($sentencia) or die (mysqli_error($conexion));
		header('Location: comentario_listar.php');
	}

mysqli_close($conexion);

?>
