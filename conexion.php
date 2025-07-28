<?php
$cn = mysqli_connect("localhost", "root", "admin123", "ORGANIZACION");
if (!$cn) { die("Error al conectar: ".mysqli_connect_error()); }
?>