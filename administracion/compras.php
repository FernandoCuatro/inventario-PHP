<?php
require_once 'config/conexion.php';
include 'config/funciones.php';
comprobar_sesion();
comprobar_rol_vendedor();
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
      <h1 class="nombre-proceso">Lista de productos</h1>
      <h4 class="nombre-modulo">Módulo factura</h4>
     </article>

     <div class="contenido-compra">
       <div class="productos">

           <?php if (isset($_GET['factura'])): ?>
             <p class="factura_activa">Se creo la factura correctamente, gestiona el <a href="factura_listar.php">pago aquí</a></p>
           <?php endif ?>

            <?php
              try {
                $statement_1 ="SELECT * FROM productos WHERE id_categoria = 1 AND estado_producto = 'A'";
                $resultado_1 = $conexion->query($statement_1) or die (mysqli_error($conexion));
              } catch (Exception $e) {
                header('location: ../index.php');
              }
            ?>
            <h2 class="categories-title">Comida rápida</h2>
            <section class="carrousel">
              <div class="carrousel-container">
              <?php foreach ($resultado_1 as $productos): ?>
              <form method="POST" action="inc/carrito.php">
              <div class="carrousel-complemet">
                <p class="categorias-tittle"><?php echo $productos['nombre_producto'] ?></p>
                  <div class="carrousel-item">
                  <img class="carrousel-item-img" src="img_productos/<?php echo $productos['img_producto'] ?>" alt="<?php echo $productos['img_producto'] ?>">
                    <div class="carrousel-item-details">
                      <div>
                      <p class="carrousel-item-details--title">$<?php echo $productos['precio_producto'] ?></p>
                        <div class="number-input-detail">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                        <input class="quantity" min="1" name="cantidad" value="1" type="number">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                        </div>

                        <div class="cart">
                        <input type="hidden" name="add_to_cart">
                        <input type="hidden" name="id_producto" value="<?php echo $productos['id_producto'] ?>">
                        <input type="hidden" name="nombre_producto" value="<?php echo $productos['nombre_producto'] ?>">
                        <input type="hidden" name="precio_producto" value="<?php echo $productos['precio_producto'] ?>">
                        <input type="hidden" name="img_producto" value="<?php echo $productos['img_producto'] ?>">
                        <button type="submit"><i class="fas fa-shopping-cart"></i></button>
                        </div>

                      </div>
                    </div>
                  </div>
              </div>
              </form>
              <?php endforeach ?>
              </div>
            </section>

            <?php
              try {
                $statement_2 ="SELECT * FROM productos WHERE id_categoria = 2 AND estado_producto = 'A'";
                $resultado_2 = $conexion->query($statement_2) or die (mysqli_error($conexion));
              } catch (Exception $e) {
                header('location: ../index.php');
              }
            ?>
            <h2 class="categories-title">Snacks</h2>
            <section class="carrousel">
              <div class="carrousel-container">
              <?php foreach ($resultado_2 as $productos): ?>
              <form method="POST" action="inc/carrito.php">
              <div class="carrousel-complemet">
                <p class="categorias-tittle"><?php echo $productos['nombre_producto'] ?></p>
                  <div class="carrousel-item">
                  <img class="carrousel-item-img" src="img_productos/<?php echo $productos['img_producto'] ?>" alt="<?php echo $productos['img_producto'] ?>">
                    <div class="carrousel-item-details">
                      <div>
                      <p class="carrousel-item-details--title">$<?php echo $productos['precio_producto'] ?></p>
                        <div class="number-input-detail">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                        <input class="quantity" min="1" name="cantidad" value="1" type="number">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                        </div>

                        <div class="cart">
                        <input type="hidden" name="add_to_cart">
                        <input type="hidden" name="id_producto" value="<?php echo $productos['id_producto'] ?>">
                        <input type="hidden" name="nombre_producto" value="<?php echo $productos['nombre_producto'] ?>">
                        <input type="hidden" name="precio_producto" value="<?php echo $productos['precio_producto'] ?>">
                        <input type="hidden" name="img_producto" value="<?php echo $productos['img_producto'] ?>">
                        <button type="submit"><i class="fas fa-shopping-cart"></i></button>
                        </div>

                      </div>
                    </div>
                  </div>
              </div>
              </form>
              <?php endforeach ?>
              </div>
            </section>

            <?php
              try {
                $statement_3 ="SELECT * FROM productos WHERE id_categoria = 3 AND estado_producto = 'A'";
                $resultado_3 = $conexion->query($statement_3) or die (mysqli_error($conexion));
              } catch (Exception $e) {
                header('location: ../index.php');
              }
            ?>
            <h2 class="categories-title">Bebidas</h2>
            <section class="carrousel">
              <div class="carrousel-container">
              <?php foreach ($resultado_3 as $productos): ?>
              <form method="POST" action="inc/carrito.php">
              <div class="carrousel-complemet">
                <p class="categorias-tittle"><?php echo $productos['nombre_producto'] ?></p>
                  <div class="carrousel-item">
                  <img class="carrousel-item-img" src="img_productos/<?php echo $productos['img_producto'] ?>" alt="<?php echo $productos['img_producto'] ?>">
                    <div class="carrousel-item-details">
                      <div>
                      <p class="carrousel-item-details--title">$<?php echo $productos['precio_producto'] ?></p>
                        <div class="number-input-detail">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                        <input class="quantity" min="1" name="cantidad" value="1" type="number">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                        </div>

                        <div class="cart">
                        <input type="hidden" name="add_to_cart">
                        <input type="hidden" name="id_producto" value="<?php echo $productos['id_producto'] ?>">
                        <input type="hidden" name="nombre_producto" value="<?php echo $productos['nombre_producto'] ?>">
                        <input type="hidden" name="precio_producto" value="<?php echo $productos['precio_producto'] ?>">
                        <input type="hidden" name="img_producto" value="<?php echo $productos['img_producto'] ?>">
                        <button type="submit"><i class="fas fa-shopping-cart"></i></button>
                        </div>

                      </div>
                    </div>
                  </div>
              </div>
              </form>
              <?php endforeach ?>
            </div>
          </section>
       </div>

       <div class="factura">
         <h2 class="factura-tittle">Carrito de compras</h2>

        <div class="contenedor-factura">
          <div class="contenido-factura">

        <?php if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1): ?>
          <?php foreach ($_SESSION["carrito"] as $producto): ?>
            <form action="inc/carrito.php" method="post">
              <div class="producto">
                <div class="prod-cont-img">
                  <img class="cont-img" src="img_productos/<?php echo $producto['foto']; ?>" alt="<?php echo $producto['foto']; ?>">  
                </div>
                <div class="prod-nombre">
                  <p><?php echo $producto['producto']; ?></p>
                </div>
                <div class="prod-cont">
                  <button type="submit" name="delete">Eliminar</button>
                  <p>Cantidad: <?php echo $producto['cantidad']; ?><br/> Total: $<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></p>
                </div>
              </div>
              <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            </form>
          <?php endforeach ?>
          <?php else: ?>
            <p class="vacio">No hay productos en su canasta</p>
          <?php endif ?>

          </div>
        </div>

         <p class="factura-descripcion">La lista de productos se añadira a factura nueva.</p>

         <?php if (isset($_SESSION["carrito"]) && count($_SESSION["carrito"]) >= 1): ?>
         <?php $tot_pag=0; foreach ($_SESSION["carrito"] as $producto): $tot_pag += number_format($producto['precio'] * $producto['cantidad'], 2); endforeach; $tot_pag =number_format($tot_pag, 2); ?>

           <p class="total">Total a pagar: <span>$<?php echo $tot_pag ?></span></p>
           
           <div class="text-center">
             <a href="factura_crear.php" class="procesar">Procesar factura de la compra</a>
           </div>
         <?php endif ?>
       </div>
     </div>

   </div>
  </div>
  </div>
 </div>

<?php mysqli_close($conexion); ?>
<?php require 'inc/scripts.php'; ?>
</body>

</html>