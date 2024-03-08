<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_comentario           = $_POST['id_comentario'];
 $comentario_estado       = $_POST['comentario_estado'];

 try {
  $sentencia="UPDATE comentarios SET estado_comentario='". $comentario_estado  ."' WHERE id_comentarios='". $id_comentario  ."'; ";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: comentario_listar.php');

 } catch (Exception $e) {
  header('location: comentario_listar.php');
 }
 
 mysqli_close($conexion);
}

if (isset($_GET['id_comentario'])) {
 $consulta = actualizar($_GET['id_comentario']);
}else{
 header('Location: comentario_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM comentarios WHERE id_comentarios='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['fecha'],
  $fila['calificacion'],
  $fila['comentario']
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
      <h1 class="comentario-crear">Editar comentario</h1>
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
         <input id="calificacion-1" class="calificacion" type="radio" name="comentario_calificacion" value="1" checked="on">
         <label for="calificacion-1" class="calificacion-label"><?php echo $consulta[1] ?></label>
        </div>
       </div>

       <p>Fecha del comentario: <?php echo $consulta[0] ?></p>
       <!--Escribir comentario-->
       <div class="contenedor-comentarios-escribir">
        <h5 class="escribir-comentario">Comentario:</h5>
        <div>
         <textarea name="comentario_contenido" class="comentario-contenido" required="on" placeholder="Escribir comentario..." cols="30" rows="10" disabled="on"><?php echo $consulta[2] ?></textarea>
        </div>
       </div>
       <!--Estado del comentario-->
       <div class="contenedor-comentario-estado">
        <h5 class="estado-comentario-opciones">Estado del comentario:</h5>
        <div>
         <select name="comentario_estado" class="estado-comentario">
          <option disabled selected>Seleccionar estado...</option>
          <option value="L">Leído
          <option value="P">No leído
         </select>
        </div>
       </div>

       <input type="hidden" name="id_comentario" value="<?php echo $_GET['id_comentario'] ?>">
       <!--Boton para guardar comentario-->
       <button class="btn-comenatrio-guardar" type="submit">Editar</button>
      </div>
     </form>

     <div class="text-center">
      <a href="comentario_listar.php">Volver a listar comentarios</a>
     </div>
    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>