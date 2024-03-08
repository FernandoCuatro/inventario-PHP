<?php 
include 'config/funciones.php';
comprobar_sesion();
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
   <div class="container-fluid text-center">

    <h1>¡Hola <?php echo $_SESSION['usuario_nombre']; ?>!</h1>
    <p>Gestiona y optimiza procesos con nosotros.</p>
    <p>Tu rol es <?php echo $_SESSION['rol_nombre']; ?>, en la izquierda selecciona el modulo que utilizaras.</p>
    
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>