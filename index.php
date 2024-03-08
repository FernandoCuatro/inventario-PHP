<?php
session_start();

// Validamos que te gamos un metodo POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 // Añadimos la conexion que esta dentro de administracion
 require_once 'administracion/config/conexion.php';

 // Recogemos el valor de las variables
 $email    = $_POST['email'];
 $password = $_POST['password'];

 // Ciframos la contraseña con el algoritmo sha512
 $password = hash('sha512' , $password);

 try {
  $busqueda = "SELECT
                      usuario_id,
                      u.rol_id,
                      rol_nombre,
                      usuario_codigo,
                      usuario_nombre,
                      usuario_apellido,
                      usuario_email
                  FROM
                      usr_usuarios u
                  INNER JOIN usr_roles r ON
                      u.rol_id = r.rol_id
                  WHERE
                  usuario_email = '". $email  ."' AND usuario_password = '". $password ."' AND usuario_estado = 'A'; ";
  $resultado_busqueda = $conexion->query($busqueda) or die (mysqli_error($conexion));
  $dato               = $resultado_busqueda->fetch_assoc();

  // Si los datos de la consulta en la posición 'id_usuario'
  // Son validos, guardamos los datos en sesiones.
  if ($dato['usuario_id'] != null) {
   $_SESSION['usuario_id']     = $dato['usuario_id'];
   $_SESSION['rol_id']         = $dato['rol_id'];
   $_SESSION['rol_nombre']     = $dato['rol_nombre'];
   $_SESSION['usuario_codigo'] = $dato['usuario_codigo'];
   $_SESSION['usuario_nombre'] = $dato['usuario_nombre'] . " " . $dato['usuario_apellido'];
   $_SESSION['usuario_email']  = $dato['usuario_email'];

   // Redireccionamos al index de administracion 
   // Con las variables ya creadas
   header('location: administracion/index.php');
  }else{
   // De lo contrario, redireccionamos a la misma pagina
   // Con un error en la url
   header('location: index.php?usuario=error');
  }

 } catch (Exception $e) {
   // Si existe un error fuera de la consulta anterior
   // Mandamos un error con la url distinto
  header('location: index.php?error=inicio');
 }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
 <?php require 'inc/meta.php'; ?>
</head>
<body>
 <!-- ESTRUCTURA 1 | BARRA DE NAVEGACION -->
 <?php // require 'inc/header.php'; ?>

 <!-- ESTRUCTURA 7 | LOGIN -->
 <section id="login">
  <form name="login" class="frmLogin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

     <?php if (isset($_GET['error'])): ?>
      <p class="alerta">Error inesperado en el sistema</p>
     <?php endif ?>

     <?php if (isset($_GET['usuario'])): ?>
      <p class="alerta">Usuario desconocido<br/>Revise sus credenciales</p>
     <?php endif ?>

     <?php if (isset($_GET['inicio'])): ?>
      <p class="alerta">Inicie sesión para tener acceso</p>
     <?php endif ?>

     <?php if (isset($_GET['acceso'])): ?>
      <p class="alerta">Su rol no es compatible<br/>con esta área de trabajo</p>
     <?php endif ?>

     <?php if (isset($_GET['proceso'])): ?>
      <p class="alerta">Se produjo un error al crear la base de datos</p>
     <?php endif ?>

     <?php if (isset($_GET['salir'])): ?>
      <p class="success">Se cerro sesión correctamente</p>
     <?php endif ?>

     <?php if (isset($_GET['database'])): ?>
      <p class="success">Se creo la base de datos exitosamente</p>
     <?php endif ?>

   <h2>Iniciar sesión</h2>
   <img id="login_img" src="imagenes/vogue.png">
   <div>
    <label id="email">Correo electrónico:</label>
    <input type="email" name="email" class="email" id="email" required="on" onkeypress="validarCorreo(this)">
    <p class="campos_alerta" id="alertaE" style="text-align: center;"></p>
   </div>
   <div>
    <label for="pw">Contraseña:</label>
    <input type="password" name="password" class="pw" id="pw" required="on" onkeypress="longitudClave(this, 5)">
    <p class="campos_alerta" id="alertaP" style="text-align: center;"></p>
   </div>
   <input type="submit" name="enviar" class="login-proceso" id="login-proceso" value="Iniciar">
  </form>

 </section>


 <!-- ESTRUCTURA 6 | FO0TER / PIE DE PAGINA -->
 <?php // require 'inc/footer.php'; ?>

 <script src="js/scripts.js"></script>
</body>
</html>