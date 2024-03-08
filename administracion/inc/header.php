<!-- Sidebar en forma de menu lateral -->
<div id="menu-navegacion">
 <header>
  <a href="index.php">
   <!-- <img src="assets/material/al-paso-nav.png" alt="al paso"> -->
  </a>
 </header>
 
 <ul class="nav">

  <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
  <?php if ($_SESSION['rol_id'] == 1): ?>
    <li><a href="compras.php"><i class="fas fa-cart-plus"></i> Carrito de compra</a></li>
    <li><a href="factura_listar.php"><i class="fas fa-file-invoice-dollar"></i> Facturas</a></li>
    <li><a href="pago_listar.php"><i class="fas fa-hand-holding-usd"></i> Pagos</a></li> 
  <?php endif ?>
  
  <?php if ($_SESSION['rol_id'] == 2): ?>
    <li><a><i class="fas fa-boxes"></i> Marcas</a></li>
    <li><a><i class="fas fa-boxes"></i> Lineas</a></li>
    <li><a href="producto_listar.php"><i class="fas fa-dolly"></i> Productos</a></li>
    <li><a><i class="far fa-comments"></i> Bodegas</a></li>
    <li><a><i class="fas fa-hand-holding-usd"></i> Pagos</a></li> 
  <?php endif ?>

  <?php if ($_SESSION['rol_id'] == 3): ?>
    <li><a href="usuario_listar.php"><i class="fas fa-users-cog"></i> Usuarios</a></li>
    <li><a href="rol_listar.php"><i class="fas fa-wrench"></i> Rol</a></li>
    <!-- <li><a href="pago_listar.php"><i class="fas fa-hand-holding-usd"></i> Pagos</a></li>  -->
    <li><a><i class="fas fa-hand-holding-usd"></i> Pagos</a></li> 
  <?php endif ?>

 </ul>
</div>