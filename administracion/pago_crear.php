<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_factura       = $_POST['id_factura'];
 $pago_total       = $_POST['pago_total'];
 $pago_descuento   = $_POST['pago_descuento'];
 $pago_descripcion = $_POST['pago_descripcion'];
 $pago_estado      = "P";

 $descuento = $pago_total * ($pago_descuento / 100);
 $pago_total = $pago_total - $descuento;
 $fecha_actual = date("Y-m-d H:i:s");

 try {
  $sentencia="INSERT INTO pagos(id_pago, id_factura, fecha, total_pago, descuento, descripcion, estado_pago) VALUES (null,'$id_factura','$fecha_actual','$pago_total','$pago_descuento','$pago_descripcion', '$pago_estado');";
  
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: pago_confirmacion.php?id_factura='.$id_factura);

 } catch (Exception $e) {
  header('location: factura_listar.php?exepcion');
 }

 mysqli_close($conexion);
}

if (isset($_GET['id_factura'])) {
 $consulta = actualizar($_GET['id_factura']);
}else{
 if ($_SERVER['REQUEST_METHOD']!='POST') {
  header('Location: factura_listar.php');
 }
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM facturas WHERE id_factura='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['id_factura'],
  $fila['total_factura']
 ];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
 <?php require 'inc/meta.php'; ?>
</head>

<body>
 <div id="vista">
  <?php require 'inc/header.php'; ?>
  <!-- Contenido general -->
  <div id="contenido-general">
   <?php require 'inc/header_superior.php'; ?>

   <!-- Espacio para el contenido a agregar -->
   <div class="container-fluid">
    <div class="contenido-entrada">
     <article class="texto-base">
      <h1 class="nombre-proceso">Crear proceso de pago</h1>
      <h4 class="nombre-modulo">Módulo pago</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="pago_crear" class="pago_crear">
      <div class="contenido-input">
       <label for="pago_total">Total a pagar: </label>
       <input type="text" name="pago_total" id="pago_total" required="on" placeholder="00,00" onkeypress="this.value = mascara(this.value)" maxlength="5" value="<?php echo $consulta[1] ?>">
       <p class="campos_alerta" id="alertaN"></p>
      </div>
      <div class="contenido-input">
       <label for="pago_descuento">Descuento:</label>
       <input type="number" name="pago_descuento" id="pago_descuento" placeholder="10" onkeyup="validar_descuento(this)" required="on">
      </div>
      <div class="contenido-input">
       <label for="pago_descripcion">Descripción del proceso:</label>
       <textarea name="pago_descripcion" class="pago_descripcion" required="on"></textarea>
      </div>

      <input type="hidden" name="id_factura" value="<?php echo $consulta[0] ?>">
      <div class="contenedor-input">
       <input type="submit" id="envio" value="Crear">
      </div>
     </form>

    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>