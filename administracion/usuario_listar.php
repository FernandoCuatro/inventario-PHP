<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

$statement="SELECT
                usuario_id,
                r.rol_nombre,
                usuario_nombre,
                usuario_apellido,
                usuario_identidad,
                usuario_codigo,
                usuario_email,
                usuario_estado
            FROM
                usr_usuarios u
            INNER JOIN usr_roles r ON
                u.rol_id = r.rol_id";
$resultado = $conexion->query($statement) or die (mysqli_error($conexion));
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
      <h1 class="nombre-proceso">Lista de usuarios</h1>
      <h4 class="nombre-modulo">Módulo usuario</h4>
     </article>

    <div class="text-center">
     <a href="usuario_crear.php" class="btn-add"><i class="fas fa-plus-square"></i> Añadir usuario</a>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th class="text-center">Rol</th>
       <th>Nombre</th>
       <th>DUI</th>
       <th>Teléfono</th>
       <th>Correo electrónico</th>
       <th>Estado</th>
       <th></th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $usuario): ?>
        <tr class="formato-celda">
         <td><?php echo $usuario['usuario_id']; ?></td> 
         <td class="text-center"><?php echo $usuario['rol_nombre']; ?></td> 
         <td><?php echo $usuario['usuario_nombre'] . " " . $usuario['usuario_apellido'];  ?></td>
         <td><?php echo $usuario['usuario_identidad']; ?></td>
         <td><?php echo $usuario['usuario_codigo']; ?></td>
         <td><?php echo $usuario['usuario_email']; ?></td>

         <td>
         <?php if ($usuario['usuario_estado']=='A'): ?>
           <?= "Activo" ?>
          <?php else: ?>
           <?= "Inactivo" ?>
          <?php endif ?>
         </td>
          <td>
           <a class="editar" href="usuario_editar.php?id_usuario=<?= $usuario['usuario_id']; ?>"><i class="fas fa-marker"></i></a>
           <a class="borrar" href="#" onclick="preguntar(<?php echo $usuario['usuario_id']?>)"><i class="far fa-trash-alt"></i></a>
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
    if(confirm('¿Estás seguro que deseas borrar el usuario?')){
        window.location.href = "usuario_eliminar.php?id_usuario="+id;
    }
  }
</script>

<?php mysqli_close($conexion); ?>
<?php require 'inc/scripts.php'; ?>
</body>

</html>