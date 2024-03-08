<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();

 $fecha_actual = date("Y-m-d H:i:s");
	$tot_pag=0; foreach ($_SESSION["carrito"] as $producto): $tot_pag += number_format($producto['precio'] * $producto['cantidad'], 2); endforeach; $tot_pag =number_format($tot_pag, 2);

 $id_usuario = $_SESSION['id_usuario'];
 $sentencia_factura="INSERT INTO facturas(id_factura, id_usuario, fecha, total_factura, estado_factura) VALUES (null, '$id_usuario','$fecha_actual','$tot_pag','A');";
 $conexion->query($sentencia_factura) or die (mysqli_error($conexion));

 $sentencia_id = "SELECT id_factura FROM facturas ORDER by id_factura DESC LIMIT 1; ";
 $resultado_id = $conexion->query($sentencia_id) or die (mysqli_error($conexion)); 
 $fila = $resultado_id->fetch_assoc();
 $id_factura_actual = $fila['id_factura'];

 foreach ($_SESSION["carrito"] as $producto) {
 $id_producto = $producto['id_producto'];
 $cantidad = $producto['cantidad'];
 $total_producto = number_format($producto['precio'] * $producto['cantidad'], 2);

 $sentencia_detalles="INSERT INTO facturas_productos(id_contenido_factura, id_factura, id_producto, cantidad, total_producto) VALUES (null, '$id_factura_actual','$id_producto','$cantidad','$total_producto');";
 $conexion->query($sentencia_detalles) or die (mysqli_error($conexion));
 }

 mysqli_close($conexion);

 header("Location: inc/limpiar_carrito.php");

?>