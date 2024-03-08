<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

if($_SERVER['REQUEST_METHOD']=='POST'){
    require_once 'config/conexion.php';

    $usuario_rol      = $_POST['usuario_rol'];
    $usuario_nombre   = $_POST['usuario_nombre'];
    $usuario_apellido = $_POST['usuario_apellido'];
    $usuario_dui      = $_POST['usuario_dui'];
    $usuario_codigo   = $_POST['usuario_codigo'];
    $usuario_email    = $_POST['usuario_email'];
    $usuario_pw       = $_POST['usuario_pw'];
    $usuario_pw       = hash('sha512' , $usuario_pw);
    $usuario_estado   = 'A';

    try {
        $sentencia="INSERT INTO usr_usuarios(usuario_id, rol_id, permiso_id, usuario_codigo, usuario_nombre, usuario_apellido, usuario_email, usuario_password, usuario_cargo, usuario_pais, usuario_identidad, usuario_oficina, usuario_estado) 
                VALUES (5,'$usuario_rol',1,'$usuario_codigo','$usuario_nombre','$usuario_apellido','$usuario_email','$usuario_pw','Cargo del usuario','El Salvador','$usuario_dui','La oficina del usuario','$usuario_estado')";

  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('location: usuario_listar.php');

 } catch (Exception $e) {
  header('location: usuario_listar.php');
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
      <h1 class="nombre-proceso">Crear usuario</h1>
      <h4 class="nombre-modulo">Módulo usuario</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="formulario" id="fowrmulario">
      <div class="form-group">
       <label for="Rol">Rol establecido al usuario:</label>
       <div class="form-group-rol">
        <select name="usuario_rol" id="usuario_rol" class="usuario_rol">
         <option disabled selected=" ">Seleccione Rol</option>
         <option value="3">Administrador</option>
         <option value="2">Gerente</option>
         <option value="1">Vendedor</option>
        </select>
       </div>
      </div>
      <br><br><br><br><br>
      <!--Primer bloque ira Nombre y correo-->
      <div class="primer-bloque">

       <!--encabezados nombre,correo-->
       <div>
        <label for="Nombre" class="form-label-nombre">Nombres:</label>
       </div>
       <div>
        <label for="correo" class="form-label-correo">Apellidos:</label>
       </div>
       <!--Inputs nombre,correo-->
       <div class="form-inputs-nombre">
        <input type="text" name="usuario_nombre" id="usuario_nombre" class="usuario_nombre" onkeypress="validarNombre(this,5)" minlength="5" maxlength="100" placeholder="Nombres">
        <p class="campos_alerta" id="alertanombre"></p>
       </div>
       <div class="form-inputs-nombre">
        <input type="text" name="usuario_apellido" id="usuario_apellido" class="usuario_apellido" onkeypress="validarApellidos(this,5)" minlength="5" maxlength="100" placeholder="Apellidos">
        <p class="campos_alerta" id="alertaapelliedos"></p>
       </div>
      </div>

      <!--Segundo bloque ira dui,nit y telefono-->
      <div class="segundo-bloque">
       <!--encabezados dui,nit,telefono-->
       <div>
        <label for="Dui" class="form-label-dui">DUI:</label>
       </div>
       <div>
        <label for="Nit" class="form-label-nit">Correo Electrónico:</label>
       </div>
       <div>
        <label for="Telefono" class="form-label-telefono">Código usuario:</label>
       </div>
       <!--Inputs dui,nit,telefono-->
       <div class="form-inputs-dui">
        <input type="text" name="usuario_dui" id="usuario_dui" class="usuario_dui " required="on" onkeypress="this.value=mascarardui(this.value)" maxlength="10" placeholder="00000000-0">
       </div>
       <div class="form-inputs-nit">
        <input type="email" name="usuario_email" id="usuario_email" class="usuario_email" required="on" onkeypress="validarcorreo(this)" maxlength="17" placeholder="correo@vogue.com">
       </div>
       <div class="form-inputs-telefono">
        <input type="text" name="usuario_codigo" id="usuario_codigo" class="usuario_codigo" required="on"  maxlength="9" placeholder="0000000000">
       </div>
       <!--Parrafos dui,nit,telefono-->
       <div class="form-parrafo-dui">
        <p class="campos_alerta" id="alertadui"></p>
       </div>
       <div class="form-parrafo-nit">
        <p class="alertacorreo" id="alertacorreo"></p>
       </div>
       <div class="form-parrafo-telefono">
        <p class="campos_alerta" id="alertCodigo"></p>
       </div>
      </div>
      <!--tercer bloque ira contra 1 -->
      <div class="tercer-bloque">
       <!--encabezado Contraseña-->
       <div>
        <label for="Password" class="form-label-password">Contraseña:</label>
       </div>
       <!--Input contraseña -->
       <div class="form-inputs-contraseña">
        <input type="Password" name="usuario_pw" id="usuario_pw" class="usuario_pw" onkeyup="validarcontra(this,5)" minlength="5" required="on" placeholder="************">
       </div>
       <div class="form-parrafo-contraseña">
        <p class="campos_alerta" id="alertacontraseña"></p>
       </div>
      </div>
      <!--encabezado repetir contraseña-->
      <div class="form-group-contraseña2">
       <label for="Password2" class="form-label-password2">Repetir Contraseña:</label>
       <!--Input contraseña -->
       <div class="form-inputs-contraseña2">
        <input type="Password" name="usuario_rept" id="usuario_rept" class="usuario_rept " onkeyup="validarcontraseña2(this,5)" required="on" placeholder="************">
       </div>
       <div class="form-parrafo-contraseña-2">
        <p class="campos_alerta" id="alertacontraseña2"></p>
       </div>
       <div class="form-button-guardar">
        <button type="submit" class="envio" id="envio">Guardar</button>
       </div>
      </div>
     </form>

    <div class="text-center">
     <a href="usuario_listar.php">Volver</a>
    </div>
    </div>
   </div>
  </div>
 </div>

<?php require 'inc/scripts.php'; ?>
</body>

</html>