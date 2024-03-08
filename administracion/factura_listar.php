<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();

$statement="SELECT id_factura, u.nombre_usuario, fecha, total_factura, estado_factura FROM facturas f inner join usuarios u on u.id_usuario = f.id_usuario";
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
      <h1 class="nombre-proceso">Lista de facturas</h1>
      <h4 class="nombre-modulo">Modulo facturas</h4>
     </article>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th></th>
       <th class="text-center">Vendedor</th>
       <th class="text-center">Fecha</th>
       <th class="text-center">Total de la factura</th>
       <th>Estado</th>
       <th></th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $facturas): ?>
        <tr class="formato-celda">
         <td><?php echo $facturas['id_factura']; ?></td> 
         <td class="text-center"><?php echo $facturas['nombre_usuario']; ?></td> 
         <td class="text-center"><?php echo $facturas['fecha']; ?></td>
         <td class="text-center">$<?php echo $facturas['total_factura']; ?></td>
         <td>
         <?php if ($facturas['estado_factura']=='A'): ?>
           <?= "Activo" ?>
          <?php else: ?>
           <?= "Inactivo" ?>
          <?php endif ?>
         </td>
          <td>
            <?php if ($facturas['estado_factura']=='A'): ?>
              <a class="editar" href="factura_editar.php?id_factura=<?= $facturas['id_factura']; ?>"><i class="fas fa-marker"></i></a>
            <?php else: ?>
              <a class="editar desabilitado" href="factura_editar.php?id_factura=<?= $facturas['id_factura']; ?>"><i class="fas fa-marker"></i></a>
            <?php endif ?>
           <a class="borrar desabilitado" href="#"><i class="far fa-trash-alt"></i></a>
           <?php if ($facturas['estado_factura']=='A'): ?>
            <a href="pago_crear.php?id_factura=<?= $facturas['id_factura']; ?>">Crear proceso de pago</a>
           <?php endif ?>
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