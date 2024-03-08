<?php 
session_start();

session_destroy();
$_SESSION = [];

header('Location: ../index.php?salir=on');
die();
?>