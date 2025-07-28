<?php
require "conexion.php";
$q = "SELECT p.nombre,
            COUNT(d.id) AS total,
            SUM(d.monto) AS recaudado
      FROM PROYECTO p
      JOIN DONACION d ON d.id_proyecto=p.id
      GROUP BY p.id
      HAVING total>2";
$r = mysqli_query($cn,$q);
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Reporte</title></head>
<body>
<h2>Proyectos con más de 2 donaciones</h2>
<table border="1"><tr><th>Proyecto</th><th>#Donaciones</th><th>Total $</th></tr>
<?php while($f=mysqli_fetch_assoc($r)){
 echo "<tr><td>{$f['nombre']}</td><td>{$f['total']}</td><td>{$f['recaudado']}</td></tr>";
} ?>
</table><br><a href="panel.php">Volver al panel</a>
</body></html>