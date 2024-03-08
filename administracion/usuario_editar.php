<?php
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_administrador();

if($_SERVER['REQUEST_METHOD']=='POST'){
 require_once 'config/conexion.php';

 $id_usuario       = $_POST['id_usuario'];
 $usuario_rol      = $_POST['usuario_rol'];
 $usuario_nombre   = $_POST['usuario_nombre'];
 $usuario_email    = $_POST['usuario_email'];
 $usuario_dui      = $_POST['usuario_dui'];
 $usuario_nit      = $_POST['usuario_nit'];
 $usuario_telefono = $_POST['usuario_telefono'];
 $usuario_estado   = $_POST['usuario_estado'];

 try {
  $sentencia="UPDATE usuarios SET id_rol='$usuario_rol', nombre_usuario='$usuario_nombre', dui='$usuario_dui', nit='$usuario_nit', telefono='$usuario_telefono', correo='$usuario_email', estado_usuario='$usuario_estado'  WHERE id_usuario='$id_usuario';";
  $conexion->query($sentencia) or die (mysqli_error($conexion));

  header('Location: usuario_listar.php');

 } catch (Exception $e) {
  header('Location: usuario_listar.php');
 }

 mysqli_close($conexion);
}

if (isset($_GET['id_usuario'])) {
 $consulta = actualizar($_GET['id_usuario']);
}else{
 header('Location: usuario_listar.php');
}

function actualizar($id) {
 require_once 'config/conexion.php';

 $sentencia="SELECT * FROM usr_usuarios WHERE usuario_id='".$id."' ";
 $resultado= $conexion->query($sentencia) or die (mysqli_error($conexion)); 
 $fila=$resultado->fetch_assoc();

 return [
  $fila['usuario_nombre'],
  $fila['usuario_apellido'],
  $fila['usuario_identidad'],
  $fila['usuario_email'],
  $fila['usuario_codigo']
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
      <h1 class="nombre-proceso">Editar usuario</h1>
      <h4 class="nombre-modulo">Módulo usuario</h4>
     </article>
     <!-- Todo listo, mucha suerte; recuerda las indicaciones. -->
     <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="usuario_editar" method="post" class="formulario" id="formulario">
      <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_GET['id_usuario'] ?>">

      <!--Grupo Rol estbalecido usuario:-->
      <div class="formulario-rol" id="rol-usuario">
       <label for="usuario" class="formulario-label">Rol estbalecido usuario:</label>
       <div class="formulario-grupo-input">
        <select name="usuario_rol" id="usuarios" class="select-usuario">
         <option value="1">Vendedor</option>
         <option value="2">Gerente</option>
         <option value="3">Administrador</option>
        </select>
       </div>
      </div><br>
      <div class="form-label">
       <!--Grupo nombre completo:-->
       <div id="grupo-nombre">
        <label for="nombre" class="formulario-label">Nombres:</label>
        <div>
         <input type="text" class="fomulario-input" name="usuario_nombre" placeholder="Ej. Juan Perez" onkeypress="validarnombre(this,10)" minlength="10" maxlength="50" required="on" value="<?php echo $consulta[0] ?>">
         <p class="formulario-input-error" id="error-nombre"></p>
        </div>
       </div>
       <!--Grupo correo electronico -->
       <div id="grupo-nombre">
        <label for="correo" class="formulario-label">Apellidos:</label>
        <div>
         <input type="text" class="fomulario-input" name="usuario_email" placeholder="ejemplo@mail.com" onkeypress="validarcorreo(this)" value="<?php echo $consulta[1] ?>">
         <p class="formulario-input-error" id="alertacorreo"></p>
        </div>
       </div>
      </div><br>
      <div class="form-label2">
       <!--Grupo DUI-->
       <div id="grupo-dui">
        <label for="dui" class="formulario-label">DUI:</label>
        <div>
         <input type="text" class="fomulario-input" name="usuario_dui" id="dui" placeholder="00000000-0" onkeypress="this.value=validardui(this.value)" maxlength="10" required="on" value="<?php echo $consulta[2] ?>">
         <p class="formulario-input-error" id="error-dui"></p>
        </div>
       </div>
       <!--Grupo NIT-->
       <div id="grupo-nit">
        <label for="nit" class="formulario-label">Correo electrónico:</label>
        <div>
         <input type="text" class="fomulario-input" name="usuario_nit" id="nit" placeholder="0000-00000-000-0" onkeypress="this.value=validarnit(this.value)" maxlength="17" required="on" value="<?php echo $consulta[3] ?>">
         <p class="formulario-input-error" id="error-nit"></p>
        </div>
       </div>
       <!--Grupo telefono-->
       <div id="grupo-telefono">
        <label for="telefono" class="formulario-label">Código empleado:</label>
        <div class="formulario-grupo-input">
         <input type="text" class="fomulario-input" name="usuario_telefono" id="telefono" placeholder="0000-0000" onkeypress="this.value=validartelf(this.value)" onblur="validartelefono(this,8)" maxlength="9" value="<?php echo $consulta[4] ?>">
         <p class="formulario-input-error" id="error-telefono"></p>
        </div>
       </div>
      </div><br>
      <!--Grupo  Estado del usuario:-->
      <div id="estado_usuario">
       <label for="usuario" class="formulario-label">Estado del usuario:</label>
       <div class="formulario-grupo-select">
        <select name="usuario_estado" id="usuario-estado" class="select-usuario">
         <option value="A">Activo</option>
         <option value="I">Inactivo</option>
        </select>
       </div>
      </div>
      <!--Botón para editar el usuario-->
      <div class="btn-usuario-editar">
       <button type="submit" class="editar" id="editar" disabled="true">Editar</button>
      </div>
      <br>
     </form>

     <div class="text-center">
      <a href="usuario_listar.php">Volver</a>
     </div>

    </div>
   </div>
  </div>
 </div>
 
 <script src="js/scripts.js"></script>
</body>

</html>