<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_pago        = $_POST['id_pago'];
 $id_factura     = $_POST['id_factura'];
 $pago_metodo    = $_POST['pago_metodo'];
 $pago_cliente   = $_POST['pago_cliente'];
 $pago_vuelto    = $_POST['pago_vuelto'];
 $pago_estado    = $_POST['pago_estado'];
 $factura_estado = "I";

 try {
  $sentencia="UPDATE pagos SET metodo_pago='$pago_metodo', pago_cliente='$pago_cliente', total_vuelto='$pago_vuelto', estado_pago='$pago_estado' WHERE id_pago='$id_pago';";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  $sentencia_factura="UPDATE facturas SET estado_factura='$factura_estado' WHERE id_factura='$id_factura';";
  $conexion->query($sentencia_factura) or die (mysqli_error($conexion));

  header('Location: comentario_crear.php?id_pago='.$id_pago);

 } catch (Exception $e) {
  header('Location: factura_listar.php');
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

 $sentencia="SELECT * FROM pagos WHERE id_factura='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['id_pago'],
  $fila['total_pago']
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
      <h1 class="nombre-proceso">Confirmar pago</h1>
      <h4 class="nombre-modulo">Módulo pago</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="pago_confirmar" id="pago-confirmar">
      <div class="formPago-metodo">
       <label for="pago-metodo">Método de pago</label>
       <div>
        <select name="pago_metodo" id="formPago-metodo">
         <option disabled selected="">Forma de pago</option>
         <option value="Efectivo">Efectivo</option>
         <option value="Electrónico">Tarjeta de crédito o débito</option>
        </select>
       </div>
      </div>
      <!---->
      <div class="formPago-total" id="pago-total">
       <label for="pago-total">Total a pagar:</label>
       <input type="text" class="formInput" name="pago_total" id="pago_total" required="on" placeholder="00.00" onkeyup="this.value = validarPagoTotal(this.value)" maxlength="5" value="<?php echo $consulta[1] ?>">
       <p class="campos-alerta" id="alertaTP"></p>
      </div>
      <div class="formPago-Cliente" id="pago-cliente">
       <label for="pago-Cliente">Pago total del cliente:</label><br>
       <input type="text" class="formInput" name="pago_cliente" id="pago_cliente" required="on" placeholder="00.00" onkeyup="this.value = validarPagoTotal(this.value)" onkeypress="vuelto_validad(this)"  maxlength="5">
       <p class="campos-alerta" id="alertaPC"></p>
      </div>
      <div class="formPago-vuelto" id="pago-vuelto">
       <label for="pago-vuelto">Vuelto para el cliente:</label>
       <input type="text" class="formInput" name="pago_vuelto" id="pago_vuelto" required="on" placeholder="00.00" onkeyup="this.value = validarPagoVuelto(this.value)" maxlength="5">
       <p class="campos-alerta" id="alertaV"></p>
      </div>
      <br>
      <div class="formEstado">
       <label for="Pago-estado">Estado de pago:</label><br>
       <div class="formPago-estado">
        <select name="pago_estado" id="pago_estado">
         <option disabled selected="">Estado</option>
         <option value="P" disabled="on">Pendiente</option>
         <option value="C">Cancelado</option>
        </select>
       </div>
      </div>

      <input type="hidden" name="id_factura" value="<?php echo $_GET['id_factura']; ?>">
      <input type="hidden" name="id_pago" value="<?php echo $consulta[0]; ?>">
      <div class="formEnviar">
       <button type="submit" id="envio" onclick=""><i class="formEnviar"></i>Confirmar</button>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
 
<?php require 'inc/scripts.php'; ?>
</body>

</html>