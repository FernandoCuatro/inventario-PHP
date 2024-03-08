<?php
include 'config/funciones.php';
comprobar_sesion();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_pago                 = $_POST['id_pago'];
 $comentario_calificacion = $_POST['comentario_calificacion'];
 $comentario_contenido    = $_POST['comentario_contenido'];
 $comentario_estado       = $_POST['comentario_estado'];
 $fecha_actual            = date("Y-m-d H:i:s");

 try {
  $sentencia="INSERT INTO comentarios(id_comentarios, id_pago, fecha, calificacion, comentario, estado_comentario) VALUES (null,'$id_pago','$fecha_actual','$comentario_calificacion','$comentario_contenido','$comentario_estado');";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('Location: pago_listar.php');

 } catch (Exception $e) {
  header('Location: factura_listar.php');
 }

 mysqli_close($conexion);
}

if (isset($_GET['id_pago'])) {
 $id_pago = $_GET['id_pago'];
}else{
 if ($_SERVER['REQUEST_METHOD']!='POST') {
  header('Location: factura_listar.php');
 }
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
      <h1 class="comentario-crear">Crear comentario</h1>
      <h4 class="comentario-modulo">Módulo comentario</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="comentario_crear">
      <!--Contenedor general-->
      <div class="contenedor-comentarios-general">
       <!--Calificacion del comentario-->
       <div class="contenedor-comentarios-rango">
        <h5 class="comentario-calificacion-rango">Calificación del comentario:</h5>
        <div>
         <input id="calificacion-1" class="calificacion" type="radio" name="comentario_calificacion" value="1">
         <label for="calificacion-1" class="calificacion-label">1</label>
         <input id="calificacion-2" class="calificacion" type="radio" name="comentario_calificacion" value="2">
         <label for="calificacion-2" class="calificacion-label">2</label>
         <input id="calificacion-3" class="calificacion" type="radio" name="comentario_calificacion" value="3">
         <label for="calificacion-3" class="calificacion-label">3</label>
         <input id="calificacion-4" class="calificacion" type="radio" name="comentario_calificacion" value="4">
         <label for="calificacion-4" class="calificacion-label">4</label>
         <input id="calificacion-5" class="calificacion" type="radio" name="comentario_calificacion" value="5">
         <label for="calificacion-5" class="calificacion-label">5</label>
         <input id="calificacion-6" class="calificacion" type="radio" name="comentario_calificacion" value="6">
         <label for="calificacion-6" class="calificacion-label">6</label>
         <input id="calificacion-7" class="calificacion" type="radio" name="comentario_calificacion" value="7">
         <label for="calificacion-7" class="calificacion-label">7</label>
         <input id="calificacion-8" class="calificacion" type="radio" name="comentario_calificacion" value="8">
         <label for="calificacion-8" class="calificacion-label">8</label>
         <input id="calificacion-9" class="calificacion" type="radio" name="comentario_calificacion" value="9">
         <label for="calificacion-9" class="calificacion-label">9</label>
         <input id="calificacion-10" class="calificacion" type="radio" name="comentario_calificacion" value="10">
         <label for="calificacion-10" class="calificacion-label">10</label>
        </div>
       </div>
       <!--Escribir comentario-->
       <div class="contenedor-comentarios-escribir">
        <h5 class="escribir-comentario">Comentario:</h5>
        <div>
         <textarea name="comentario_contenido" class="comentario-contenido" required="on" placeholder="Escribir comentario..." cols="30" rows="10"></textarea>
        </div>
       </div>
       <!--Estado del comentario-->
       <div class="contenedor-comentario-estado">
        <h5 class="estado-comentario-opciones">Estado del comentario:</h5>
        <div>
         <select name="comentario_estado" class="estado-comentario">
          <option disabled selected>Seleccionar estado...</option>
          <option value="L">Leído
          <option value="P" disabled="on">No leído
         </select>
        </div>
       </div>

       <input type="hidden" name="id_pago" value="<?php echo $id_pago ?>">
       <!--Boton para guardar comentario-->
       <button class="btn-comenatrio-guardar" type="submit">Guardar</button>
      </div>
     </form>

     <div class="text-center">
      <a href="pago_listar.php">Omitir comentario</a>
     </div>
    </div>
   </div>
  </div>
 </div>
 
<?php require 'inc/scripts.php'; ?>
</body>

</html>