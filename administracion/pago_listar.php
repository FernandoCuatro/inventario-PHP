<?php
include 'config/funciones.php';
comprobar_sesion();

require_once 'config/conexion.php';

$statement="SELECT * FROM pagos";
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
      <h1 class="nombre-proceso">Lista de Pagos</h1>
      <h4 class="nombre-modulo">Modulo pagos</h4>
     </article>

    <div class="text-center">
     <a href="#" class="btn-add desabilitado"><i class="fas fa-plus-square"></i> Añadir pago</a><br/><br/>
     <p>Los pagos se añaden al finalizar un pago de una factura.</p>
     <p>Presiona <i class="fas fa-file-pdf"></i> para generar la factura del pago.</p>
     <p>Al generar la factura del pago, tendrá una demora máxima de 30 segundos.</p>
    </div>

    <div class="contenedor-tabla">
     <table class="contenedor-datos">
      <thead>
       <tr>
       <th class="text-center">Pago</th>
       <th></th>
       <th>Fecha</th>
       <th class="text-center">Total a pagar</th>
       <th class="text-center">Descuento</th>
       <th class="text-center">Pago del cliente</th>
       <th class="text-center">Vuelto al cliente</th>
       <th>Descripción</th>
       <th>Estado</th>
       <th></th>
       </tr>
      </thead>
      <tbody>
       <?php foreach ($resultado as $pago): ?>
        <tr class="formato-pago-celda">
         <td class="text-center">
           #<?php echo $pago['id_pago']; ?> <br/>

          <?php if ($pago['estado_pago']!='P'): ?>
           <a class="pdf" href="pago_imprimir.php?id_factura=<?= $pago['id_factura']; ?>&id_pago=<?php echo $pago['id_pago']; ?>" target="_black">
            <i class="fas fa-file-pdf"></i>
           </a>

          <?php endif ?>
         </td> 
         <td class="formato-pago-factura">Factura #<?php echo $pago['id_factura']; ?></td> 
         <td class="formato-pago"><?php echo $pago['fecha']; ?></td>
         <td class="text-center">$<?php echo $pago['total_pago']; ?><br/ ><?php echo $pago['metodo_pago']; ?></td>
         <td class="text-center"><?php echo $pago['descuento']; ?>%</td>
         <td class="text-center">$<?php echo $pago['pago_cliente']; ?></td>
         <td class="text-center">$<?php echo $pago['total_vuelto']; ?></td>
         <td><?php echo $pago['descripcion']; ?></td>
         <td>
         <?php if ($pago['estado_pago']=='P'): ?>
           <?= "Pendiente" ?>
          <?php else: ?>
           <?= "Cancelado" ?>
          <?php endif ?>
         </td>

          <td>
          <?php if ($pago['estado_pago']=='P'): ?>
            <a class="editar" href="factura_editar.php?id_factura=<?= $pago['id_factura']; ?>"><i class="fas fa-marker"></i></a>
          <?php else: ?>
           <a class="editar desabilitado" href="factura_editar.php?id_factura=<?= $pago['id_factura']; ?>"><i class="fas fa-marker"></i></a>
          <?php endif ?>
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