<?php 
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_factura     = $_POST['id_factura'];
 $factura_total  = $_POST['factura_total'];
 $factura_estado = $_POST['factura_estado'];

 try {
  $sentencia="UPDATE facturas SET total_factura='$factura_total', estado_factura='$factura_estado' WHERE id_factura='$id_factura';";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('Location: factura_listar.php');

 } catch (Exception $e) {
  header('Location: factura_listar.php');
 }
}

if (isset($_GET['id_factura'])) {
 $consulta = actualizar($_GET['id_factura']);
}else{
 header('Location: factura_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM facturas WHERE id_factura='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['id_factura'],
  $fila['fecha'],
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
      <h1 class="nombre-proceso">Editar facturas</h1>
      <h4 class="nombre-modulo">Modulo facturas</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="factura_editar">
      <div>
       <div class="form-group">
        <label class="nombre">Total a facturar:</label><br>
        <input type="text" name="factura_total" min="1" step="0.01" placeholder="00,00" onkeyup="this.value = mascara(this.value)" maxlength="5" required value="<?php echo $consulta[2]; ?>">
        <p class="campos_alerta" id="alertaN"></p>
       </div>
       <div class="form-group">
        <label class="nombre">Estado de la factura:</label><br>
        <select name="factura_estado" required>
         <option hidden selected value="">Estado</option>
         <option value="A">Activo</option>
         <option value="I">Inactivo</option>
        </select>
       </div>
       <input type="hidden" name="id_factura" value="<?php echo $consulta[0]; ?>">
       <input type="submit" class="editar" id="envio" value="Editar">
      </div>
     </form>

    <div class="text-center">
     <a href="factura_listar.php">Volver</a>
    </div>
    </div>
   </div>
  </div>
 </div>

 <?php mysqli_close($conexion); ?>
 <script src="js/scripts.js"></script>
</body>

</html>