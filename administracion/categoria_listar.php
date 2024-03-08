<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

$statement="SELECT * FROM categoria";
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
      <h1 class="nombre-proceso">Lista de categorías</h1>
      <h4 class="nombre-modulo">Módulo categorías</h4>
     </article>

    <div class="text-center">
     <a href="#" class="btn-add desabilitado"><i class="fas fa-plus-square"></i> Añadir categoria</a>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th>Categoría</th>
       <th>Descripción</th>
       <th>Estado</th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $categoria): ?>
        <tr class="formato-celda">
         <td><?php echo $categoria['id_categoria']; ?></td> 
         <td><?php echo $categoria['nombre_categoria']; ?></td>
         <td><?php echo $categoria['descripcion']; ?></td>
         <td>
         <?php if ($categoria['estado_categoria']=='A'): ?>
           <?= "Activo" ?>
          <?php else: ?>
           <?= "Inactivo" ?>
          <?php endif ?>
         </td>
          <td>
           <a class="editar" href="categoria_editar.php?id_categoria=<?= $categoria['id_categoria']; ?>"><i class="fas fa-marker"></i></a>
           <a class="borrar desabilitado" href="#"><i class="far fa-trash-alt"></i></a>
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

<?php mysqli_close($conexion); ?>
<?php require 'inc/scripts.php'; ?>
</body>

</html>