<?php 
session_start();

unset($_SESSION["carrito"]);

header('Location: ../compras.php?factura=on');
?>