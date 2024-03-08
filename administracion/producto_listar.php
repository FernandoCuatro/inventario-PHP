<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

$statement="SELECT producto_id, marca_nombre, producto_codigo, producto_nombre, producto_precio, producto_presentacion, producto_unidades, producto_foto_url, p.producto_descripcion, producto_estado FROM in_productos p inner join in_marca c on c.marca_id = p.marca_id";
$resultado= $conexion->query($statement) or die (mysqli_error($conexion));
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
      <h1 class="nombre-proceso">Lista de Productos</h1>
      <h4 class="nombre-modulo">Módulo Producto</h4>
     </article>

    <div class="text-center">
     <a href="producto_crear.php" class="btn-add"><i class="fas fa-plus-square"></i> Añadir productos</a>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th class="text-center">Categoría</th>
       <th>Código</th>
       <th>Nombre</th>
       <th>Precio</th>
       <th>Fabricación -<br/>Vencimiento</th>
       <th>Imagen</th>
       <th>Descripción</th>
       <th>Estado</th>
       <th></th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $producto): ?>
        <tr class="formato-celda formato-producto">
         <td class="text-center"><?php echo $producto['producto_id']; ?></td> 
         <td class="text-center"><?php echo $producto['marca_nombre']; ?></td>
         <td><?php echo $producto['producto_codigo']; ?></td>
         <td><?php echo $producto['producto_nombre']; ?></td>
         <td>$<?php echo $producto['producto_precio']; ?></td>
         <td><?php echo $producto['producto_unidades']; ?> -<br/><?php echo $producto['producto_presentacion']; ?></td>
         <td class="formato-pago"><img src="img_productos/<?php echo $producto['producto_foto_url']; ?>" alt="<?php echo $categoria['producto_foto_url']; ?>" style="width: 95%;"></td>
         <td class="formato-pago formato-descripcion"><?php echo $producto['producto_descripcion']; ?></td>
         <td class="text-center">
         <?php if ($producto['estado_producto']=='A'): ?>
           <?= "Activo" ?>
          <?php else: ?>
           <?= "Inactivo" ?>
          <?php endif ?>
         </td>
          <td>
           <a class="editar" href="producto_editar.php?id_producto=<?= $producto['id_producto']; ?>"><i class="fas fa-marker"></i></a>
           <a class="borrar" href="#" onclick="preguntar(<?php echo $producto['id_producto']?>)"><i class="far fa-trash-alt"></i></a>
         </td>
        </tr>
       <?php endforeach ?>
      </tbody>
     </table>
    </div>

   </div>
  </div>
  </div>
 </div>

<script type="text/javascript">
  function preguntar(id){
    if(confirm('¿Estás seguro que deseas borrar el producto?')){
        window.location.href = "producto_eliminar.php?id_producto="+id;
    }
  }
</script>

 <?php mysqli_close($conexion); ?>
<?php require 'inc/scripts.php'; ?>
</body>

</html>