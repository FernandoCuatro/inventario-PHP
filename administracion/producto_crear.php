<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 if (is_uploaded_file($_FILES["producto_imagen"]["tmp_name"])){
  if ($_FILES["producto_imagen"]["type"]=="image/jpeg"|| $_FILES["producto_imagen"]["type"]=="image/jpg" || $_FILES["producto_imagen"]["type"]=="image/png"){
   
    $ruta = "img_productos/"; 
    $nombrefinal= trim ($_FILES['producto_imagen']['name']); 
    $nombrefinal= str_replace(" ", "", $nombrefinal);
    $upload= $ruta . $nombrefinal;  

    if(move_uploaded_file($_FILES['producto_imagen']['tmp_name'], $upload)) { 

    $producto_categoria   = $_POST['producto_categoria'];
    $producto_nombre      = $_POST['producto_nombre'];
    $producto_fabricacion = $_POST['producto_fabricacion'];
    $producto_descripcion = $_POST['producto_descripcion'];
    $producto_codigo      = $_POST['producto_codigo'];
    $producto_precio      = $_POST['producto_precio'];
    $producto_expiracion  = $_POST['producto_expiracion'];
    $producto_estado      = 'A';

    try {
     $sentencia="INSERT INTO productos (id_producto, id_categoria, codigo_producto, nombre_producto, precio_producto, fecha_fabricacion, fecha_expiracion, img_producto, descripcion, estado_producto) 
     VALUES (null, '$producto_categoria','$producto_codigo','$producto_nombre','$producto_precio','$producto_fabricacion','$producto_expiracion','$nombrefinal','$producto_descripcion','$producto_estado');";
     
     $conexion->query($sentencia) or die (mysqli_error($conexion));

     header('location: producto_listar.php');

    } catch (Exception $e) {
     header('location: producto_listar.php');
    }

    }
  }

 }else{
  header('Location: producto_listar.php');
 }

  mysqli_close($conexion);
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
      <h1 class="nombre-proceso">Crear Producto</h1>
      <h4 class="nombre-modulo">Módulo Producto</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="producto_crear" class="producto-crear" enctype="multipart/form-data">
      <div class="imput-producto-crear">
       <label for="categoria_producto_crear">Categoría del producto:</label>
       <select name="producto_categoria" class="sl-producto-crear" id="categoria_producto_crear" required="on" onkeypress="validar_categoria_producto_crear()">
        <option value="">Selecione una Categoría...</option>
        <option value="1">Comida rápida</option>
        <option value="2">Snacks</option>
        <option value="3">Bebidas</option>
       </select>
       <label class="error-producto-crear" id="error_categoria_producto_crear"></label>
       <br><br>
       <label for="nombre_producto_crear">Nombre del producto:</label>
       <input type="text" name="producto_nombre" required="on" id="nombre_producto_crear" onkeypress="validar_nombre_producto_crear()" minlength="3" maxlength="15" placeholder="Digite el Nombre">
       <label class="error-producto-crear" id="error_nombre_producto_crear"></label>
       <br><br>
       <label for="fecha_fabricacion_producto_crear">Fecha de fabricación:</label>
       <input type="date" name="producto_fabricacion" required="on" id="fecha_fabricacion_producto_crear" onkeypress="validar_fecha_fabricacion_producto_crear()" max="<?php echo date("Y-m-d"); ?>">
       <label class="error-producto-crear" id="error_fecha_fabricacion_producto_crear"></label>
       <br><br>
       <label for="descripcion_producto_crear">Descripción del producto:</label>
       <textarea name="producto_descripcion" class="tt-producto-crear" id="descripcion_producto_crear" cols="40" rows="3" required="on" onkeypress="validar_descripcion_producto_crear()" placeholder="Digite la Descripción"></textarea>
       <label class="error-producto-crear" id="error_descripcion_producto_crear"></label>
      </div>

      <div class="imput-producto-crear">
       <label for="codigo_producto_crear">Código del producto:</label>
       <input type="text" name="producto_codigo" required="on" id="codigo_producto_crear" onkeypress="validar_codigo_producto_crear()" placeholder="Digite el Codigo del producto" minlength="4" maxlength="10">
       <label class="error-producto-crear" id="error_codigo_producto_crear"></label>
       <br><br>
       <label for="precio_producto_crear">Precio:</label>
       <input type="text" name="producto_precio" id="precio_producto_crear" required="on" placeholder="00.00" onkeyup="this.value = validarproducto_precio(this.value)" maxlength="5">
       <label class="error-producto-crear" id="error_precio_producto_crear"></label>
       <br><br>
       <label for="fecha_expiracion_producto_crear">Fecha de expiración:</label>
       <input type="date" name="producto_expiracion" required="on" id="fecha_expiracion_producto_crear" onkeypress="validar_fecha_expiracion_producto_crear()" min="<?php echo date("Y-m-d"); ?>">
       <label class="error-producto-crear" id="error_fecha_expiracion_producto_crear"></label>
       <br><br>
      </div>

      <div class="imput-producto-crear">
       <br><br><br><br><br><br>
       <label for="imagen_producto_crear">Imagen del producto:</label>
       <input type="file" name="producto_imagen" class="examinar-producto-crear" accept="image/png, image/jpeg" required="on">
       <label class="error-producto-crear" id="error_imagen_producto_crear"></label>
      </div>

      <div class="guardar-producto-crear">
       <input type="submit" value="Guardar">
      </div>
    </div>
   </div>
   </form>

   <div class="text-center">
    <a href="producto_listar.php">Volver</a>
   </div>

  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>