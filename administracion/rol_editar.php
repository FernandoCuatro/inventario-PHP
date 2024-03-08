<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_rol           = $_POST['id_rol'];
 $rol_estado       = $_POST['rol_estado'];
 $rol_descripcion  = $_POST['rol_descripcion'];

 try {
  $sentencia="UPDATE usr_roles SET rol_descripcion='". $rol_descripcion  ."', rol_estado='". $rol_estado ."' WHERE rol_id='". $id_rol  ."'; ";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: rol_listar.php');

 } catch (Exception $e) {
  header('location: rol_listar.php');
 }

 mysqli_close($conexion);
}

if (isset($_GET['id_rol'])) {
 $consulta = actualizar($_GET['id_rol']);
}else{
 header('Location: rol_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM usr_roles WHERE rol_id='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['rol_nombre'],
  $fila['rol_descripcion']
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
      <h1 class="nombre-proceso">Editar rol</h1>
      <h4 class="nombre-modulo">Módulo rol</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="rol_editar">
      <input type="hidden" name="id_rol" id="id_rol" value="<?php echo $_GET['id_rol'] ?>">

      <div class="contenido-input">
       <label for="rol_nombre">Rol: </label>
       <input type="text" name="rol_nombre" id="rol_nombre" value="<?php echo $consulta[0] ?>" disabled="on">
      </div>

      <div class="contenido-input">
       <label for="">Estado del Rol:</label>
       <select name="rol_estado" required="on" class="rol_estado">
        <option value="A">Activo</option>
        <option value="I">Inactivo</option>
       </select>
      </div>

      <div class="contenido-input">
       <label for="rol_descripcion">Descripción del Rol:</label>
       <textarea name="rol_descripcion" class="rol_descripcion" required="on" placeholder="Texto correspondiente a la descripción"><?php echo $consulta[1] ?></textarea>
      </div>

      <div class="contenedor-input">
       <input type="submit" value="Editar">
      </div>
     </form>

     <div class="text-center">
      <a href="rol_listar.php">Volver</a>
     </div>

    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>