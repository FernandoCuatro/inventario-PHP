<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_gerente();

$statement="SELECT * FROM comentarios";
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
      <h1 class="nombre-proceso">Lista de comentario</h1>
      <h4 class="nombre-modulo">Módulo comentario</h4>
     </article>

    <div class="text-center">
     <a href="#" class="btn-add desabilitado"><i class="fas fa-plus-square"></i> Añadir comentario</a><br/><br/>
     <p>Los comentarios se añaden al finalizar un pago</p>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th class="text-center">Pago</th>
       <th>Fecha</th>
       <th class="text-center">Calificacion</th>
       <th>Comentario</th>
       <th>Estado</th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $comentario): ?>
        <tr class="formato-celda">
         <td><?php echo $comentario['id_comentarios']; ?></td> 
         <td class="text-center">#<?php echo $comentario['id_pago']; ?></td> 
         <td><?php echo $comentario['fecha']; ?></td>
         <td class="text-center"><?php echo $comentario['calificacion']; ?></td>
         <td><?php echo $comentario['comentario']; ?></td>
         <td>
         <?php if ($comentario['estado_comentario']=='L'): ?>
           <?= "Leido" ?>
          <?php else: ?>
           <?= "Pendiente" ?>
          <?php endif ?>
         </td>
          <td>
           <a class="editar" href="comentario_editar.php?id_comentario=<?= $comentario['id_comentarios']; ?>"><i class="fas fa-marker"></i></a>
           <a class="borrar" href="comentario_eliminar.php?id_comentario=<?= $comentario['id_comentarios']; ?>"><i class="far fa-trash-alt"></i></a>
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