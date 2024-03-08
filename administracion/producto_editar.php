<?php 
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_producto           = $_POST['id_producto'];
 $producto_categoria    = $_POST['producto_categoria'];
 $producto_codigo       = $_POST['producto_codigo'];
 $nombre_producto       = $_POST['nombre_producto'];
 $producto_precio       = $_POST['producto_precio'];
 $producto_fabricacion  = $_POST['producto_fabricacion'];
 $producto_expiracion   = $_POST['producto_expiracion'];
 $producto_descripcion  = $_POST['producto_descripcion'];
 $producto_estado       = $_POST['producto_estado'];

 try {
  $sentencia="UPDATE productos SET id_categoria='$producto_categoria',codigo_producto='$producto_codigo',nombre_producto='$nombre_producto',precio_producto='$producto_precio',fecha_fabricacion='$producto_fabricacion',fecha_expiracion='$producto_expiracion',descripcion='$producto_descripcion',estado_producto='$producto_estado' WHERE id_producto='$id_producto';";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: producto_listar.php');

 } catch (Exception $e) {
  header('location: producto_listar.php');
 }

 mysqli_close($conexion);
}

if (isset($_GET['id_producto'])) {
 $consulta = actualizar($_GET['id_producto']);
}else{
 header('Location: producto_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM productos WHERE id_producto='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['codigo_producto'],
  $fila['nombre_producto'],
  $fila['precio_producto'],
  $fila['fecha_fabricacion'],
  $fila['fecha_expiracion'],
  $fila['img_producto'],
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
      <h1 class="nombre-proceso">Editar Producto</h1>
      <h4 class="nombre-modulo">Módulo Producto</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="editar">
      <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $_GET['id_producto'] ?>">

      <!--encabezado de categoria producto-->
      <div class="editar-producto">
       <label for="editar">Categoría Producto:</label>
      </div>
      <!--encabezado de codigo producto-->
      <div class="codigo-producto">
       <label for="codigo">Código Producto:</label>
      </div>
      <!--seleccion de categoria producto-->
      <div class="select-categoria">
       <select name="producto_categoria" id="producto_categoria" required="on">
        <option value="1">Comida rápida</option>
        <option value="2">Snacks</option>
        <option value="3">Bebidas</option>
       </select>
      </div>
      <!--registro de codigo producto-->
      <div class="codigo-producto">
       <input type="text" name="producto_codigo" id="producto_codigo" required="on" onblur="validarproducto_codigo(this,5)" value="<?php echo $consulta[0] ?>">
       <p class="codigo_producto" id="alertacp"></p>
      </div>
      <br>
      <!--encabezado de nombre producto-->
      <div class="nombre-producto">
       <label for="nombre">Nombre del Producto:</label>
      </div>
      <!--encabezado de nombre producto-->
      <div class="precio">
       <label for="precio">Precio:</label>
      </div>
      <!--registro de nombre producto-->
      <div class="nombre-producto">
       <input type="text" required="on" onblur="" name="nombre_producto" id="nombre_producto" placeholder="Nombre del producto" value="<?php echo $consulta[1] ?>">
      </div>
      <!--registro de nombre producto-->
      <div class="precio-producto">
       <input type="text" name="producto_precio" id="producto_precio" required="on" step="00.01" placeholder="00.00" onkeyup="this.value = validarproducto_precio(this.value)" maxlength="5" value="<?php echo $consulta[2] ?>">
       <p class="precio_producto" id="alertavp">
      </div>
      <br>
      <!--encabezado de fecha de fabricacion producto-->
      <div class="Fecha-fabricacion">
       <label for="Fechaf">Fecha de fabricación :</label>
      </div>
      <!--encabezado de fecha de expiracion producto-->
      <div class="Fecha-vencimiento">
       <label for="Fechav">Fecha de vencimiento:</label>
      </div>
      <!--encabezado de imagen producto-->
      <div class="Imagen">
       <label for="descripcion">Imagen del producto: </label>
      </div>
      <!--registro de fecha de fabricacion producto-->
      <div class="Fecha-fabri">
       <input type="date" id="producto_fabricacion" required="on" name="producto_fabricacion" max="<?php echo date("Y-m-d"); ?>" value="<?php echo $consulta[3] ?>">
      </div>
      <!--registro de fecha de expiracion producto-->
      <div class="Fecha-venc">
       <input type="date" id="producto_expiracion" name="producto_expiracion" required="on" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $consulta[4] ?>">
      </div>
      <div class="imagen-produ">
       <img src="img_productos/<?php echo $consulta[5] ?>" alt="img_producto" style="width: 100%;">
      </div>
      <!--encabezado de descripcion producto-->
      <div class="Descripcion">
       <label for="descripcion">Descripción de producto:</label>
      </div>
      <!--encabezado de estado producto-->
      <div class="Estado">
       <label for="estado">Estado de Producto:</label>
      </div>
      <!--registro de descripcion producto-->
      <div class="descrip_txt">
       <textarea name="producto_descripcion" cols="40" rows="5"><?php echo $consulta[6] ?></textarea>
      </div>
      <!--registro de estado de producto-->
      <div class="seleccion_estado_producto">
       <select name="producto_estado" id="producto_estado">
        <option value="A">Activo</option>
        <option value="I">Inactivo</option>
       </select>
      </div>
      <div class="Enviar">
       <button type="submit" class="enviar" id="envio">Editar</button>
      </div>
     </form>

     <div class="text-center">
      <a href="producto_listar.php">Volver</a>
     </div>
    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>