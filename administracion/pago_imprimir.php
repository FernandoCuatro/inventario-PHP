<?php 
include 'config/funciones.php';
comprobar_sesion();

ini_set('memory_limit', '12M');

if (isset($_GET['id_factura'])) {
 $facturas = obtener_factura($_GET['id_factura']);
} else {
 header('Location: pago_listar.php');
}

if (isset($_GET['id_pago'])) {
 $pagos = obtener_pago($_GET['id_pago']);
} else {
 header('Location: pago_listar.php');
}

 function obtener_factura($id) {
  require 'config/conexion.php';

  $sentencia = "SELECT id_factura, u.nombre_usuario, fecha, total_factura FROM facturas f inner join usuarios u on u.id_usuario = f.id_usuario WHERE id_factura='".$id."' ";
  $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
  $fila=$resultado->fetch_assoc();

  return [
   $fila['id_factura'],
   $fila['nombre_usuario'],
   $fila['fecha'],
   $fila['total_factura']
  ];
 }

 require 'config/conexion.php';
 $statement_fact_produc = "SELECT cantidad, total_producto, p.precio_producto, p.nombre_producto FROM facturas_productos f inner join productos p on p.id_producto = f.id_producto WHERE id_factura='".$_GET['id_factura']."' ";
 $resultado_fact_produc = $conexion->query($statement_fact_produc) or die (mysqli_error($conexion));

 function obtener_pago($id) {
  require 'config/conexion.php';

  $sentencia = "SELECT * FROM pagos WHERE id_pago='".$id."' ";
  $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
  $fila=$resultado->fetch_assoc();

  return [
   $fila['id_pago'],
   $fila['id_factura'],
   $fila['fecha'],
   $fila['metodo_pago'],
   $fila['total_pago'],
   $fila['descuento'],
   $fila['pago_cliente'],
   $fila['total_vuelto'],
   $fila['descripcion']
  ];
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Imprimir factura del pago</title>
</head>
<body>

<?php ob_start(); ?>
<h2 style="text-align: center;"><b>AL PASO</b></h2>

 <table style="margin: 0px auto; width: 100%;">
   <tr style="text-align: center;">
    <td>
     <p>Vendedor: <b><?php echo $facturas[1] ?></b></p>
     <p><?php echo $pagos[2] ?></p>
     <p>Factura # <b><?php echo $_GET['id_factura'] ?></b> | Pago # <b><?php echo $_GET['id_pago'] ?></b></p>
    </td>
   </tr>
 </table>

 <hr/>
 <p style="text-align: center;">Cantidad x Precio</p>
 <table style="margin: 0px auto; width: 100%;">
  <thead>
   <tr>
    <th>Cantidad</th>
    <th>Precio</th>
    <th>Producto</th>
    <th>Total a pagar</th>
   </tr>
  </thead>
  <tbody style="text-align: center;">
   <?php foreach ($resultado_fact_produc as $detalles): ?>
    <tr>
     <td><?php echo $detalles['cantidad']; ?></td> 
     <td>$<?php echo $detalles['precio_producto']; ?></td>
     <td><?php echo $detalles['nombre_producto']; ?></td>
     <td>$<?php echo $detalles['total_producto']; ?></td>
    </tr>
   <?php endforeach ?>
  </tbody>
 </table>

 <p style="text-align: center;">Metodo de pago: <b><?php echo $pagos[3] ?></b></p>
 <p style="text-align: center;">Descuento: <b><?php echo $pagos[5] ?>%</b></p>
 <p style="text-align: center;">Pago sin descuento: <b>$<?php echo $facturas[3] ?></b></p>
 <table style="margin: 20px auto; width: 100%;">
  <thead>
   <tr>
    <th>Pago total</th>
    <th>Pago del cliente</th>
    <th>Vuelto</th>
    <th>Total a facturar:</th>
   </tr>
  </thead>
  <tbody style="text-align: center;">
   <tr>
     <td>$<?php echo $pagos[4] ?></td> 
     <td>$<?php echo $pagos[6] ?></td>
     <td>$<?php echo $pagos[7] ?></td>
     <td><b>$<?php echo $pagos[4] ?></b></td>
   </tr>
  </tbody>
 </table>

 <p style="text-align: center;">¡Gracias por preferirnos, te esperamos pronto!</p>

 <p style="text-align: center;"><b>AL PASO</b></p>

<?php
 require_once 'dompdf/autoload.inc.php';
 use Dompdf\Dompdf;
 $dompdf = new DOMPDF();
 $dompdf->load_html(ob_get_clean());
 $dompdf->render();
 $pdf = $dompdf->output();
 $filename = "factura#". $_GET['id_factura'] ."_alpaso.pdf";
 file_put_contents($filename, $pdf);
 $dompdf->stream($filename);
?>
 
 <?php mysqli_close($conexion); ?>
</body>
</html>