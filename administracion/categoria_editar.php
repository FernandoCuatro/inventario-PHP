<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_categoria           = $_POST['id_categoria'];
 $categoría_estado       = $_POST['categoría_estado'];
 $categoría_descripcion  = $_POST['categoría_descripcion'];

 try {
  $sentencia="UPDATE categoria SET descripcion='". $categoría_descripcion  ."',estado_categoria='". $categoría_estado ."' WHERE id_categoria='". $id_categoria  ."'; ";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: categoria_listar.php');

 } catch (Exception $e) {
  header('location: categoria_listar.php');
 }
 
 mysqli_close($conexion);
}

if (isset($_GET['id_categoria'])) {
 $consulta = actualizar($_GET['id_categoria']);
}else{
 header('Location: categoria_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM categoria WHERE id_categoria='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['nombre_categoria'],
  $fila['descripcion']
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
      <h1 class="nombre-proceso">Editar categoría</h1>
      <h4 class="nombre-modulo">Módulo categoría</h4>
     </article>

     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="categoria_editar">
      <div>
       <input type="hidden" name="id_categoria" id="id_categoria" value="<?php echo $_GET['id_categoria'] ?>">

       <div class="form-group">
        <label class="nombre">Categoría</label><br>
        <input type="text" name="categoría_nombre" value="<?php echo $consulta[0] ?>" disabled>
       </div>
       
       <div class="form-group">
        <label class="nombre">Estado de la categoría:</label>
        <select name="categoría_estado" required>
         <option hidden selected value="">Estado</option>
         <option value="A">Activo
         <option value="I">Inactivo
        </select>
       </div>

       <div class="form-group" id="descripcion">
        <label class="nombre">Descripción de la categoría:</label>
        <textarea name="categoría_descripcion" value="categoría_descripcion" cols="34" rows="5" required placeholder="Texto correspondiente a la descripción"><?php echo $consulta[1] ?></textarea>
       </div>

       <input type="submit" value="Editar" class="editar">
      </div>
     </form>

     <div class="text-center">
      <a href="categoria_listar.php">Volver</a>
     </div>
    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>