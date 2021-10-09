<?php 
session_start();
unset($_SESSION['name']);
session_destroy();
header('Location:login-2.php');
?>