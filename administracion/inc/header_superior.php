<nav class="navbar navbar-default">
 <div class="container-fluid">
  <ul class="nav navbar-nav navbar-right">
   <li><a><i class="fas fa-user-cog"></i> <?php echo $_SESSION['rol_nombre']; ?></a></li>
   <li><a><i class="far fa-user-circle"></i> <?php echo $_SESSION['usuario_email']; ?></a></li>
   <li><a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
  </ul>
 </div>
</nav>