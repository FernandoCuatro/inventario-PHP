<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

$statement="SELECT * FROM usr_roles";
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
      <h1 class="nombre-proceso">Lista de Roles</h1>
      <h4 class="nombre-modulo">Módulo Rol</h4>
     </article>

    <div class="text-center">
     <a href="#" class="btn-add desabilitado"><i class="fas fa-plus-square"></i> Añadir Rol</a>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th>Rol</th>
       <th>Descripción</th>
       <th>Estado</th>
       </tr>
      </thead>
      <tbody>
       <?php foreach($resultado as $rol): ?>
        <tr class="formato-celda">
         <td><?php echo $rol['rol_id']; ?></td> 
         <td><?php echo $rol['rol_nombre']; ?></td>
         <td><?php echo $rol['rol_descripcion']; ?></td>
         <td>
         <?php if ($rol['rol_estado']=='A'): ?>
           <?= "Activo" ?>
          <?php else: ?>
           <?= "Inactivo" ?>
          <?php endif ?>
         </td>
          <td>
           <a class="editar" href="rol_editar.php?id_rol=<?= $rol['rol_id']; ?>"><i class="fas fa-marker"></i></a>
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