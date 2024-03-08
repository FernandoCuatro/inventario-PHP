<?php 
session_start();

function comprobar_sesion(){
		if(!isset($_SESSION['usuario_id'])){
	 header('Location: ../index.php?inicio=error');
	}
}

function comprobar_rol_vendedor(){
	$rol = $_SESSION['rol_id'];
		if($rol != 1){
	 header('Location: ../index.php?acceso=off');
	}
}

function comprobar_rol_gerente(){
	$rol = $_SESSION['rol_id'];
		if($rol != 2){
	 header('Location: ../index.php?acceso=off');
	}
}

function comprobar_rol_administrador(){
	$rol = $_SESSION['rol_id'];
		if($rol != 3){
	 header('Location: ../index.php?acceso=off');
	}
}

?>	