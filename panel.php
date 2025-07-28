<?php
require "conexion.php";

/* ----- INSERCIONES BASICAS ----- */
if (isset($_POST['accion'])) {

  if ($_POST['accion'] == 'proyecto') {
      $sql = "INSERT INTO PROYECTO(nombre,descripcion,presupuesto,inicio,fin)
              VALUES('{$_POST['nombre']}','{$_POST['descripcion']}',{$_POST['presupuesto']},
                     '{$_POST['inicio']}','{$_POST['fin']}')";
  }

  if ($_POST['accion'] == 'donante') {
      $sql = "INSERT INTO DONANTE(nombre,email,direccion,telefono)
              VALUES('{$_POST['nombre']}','{$_POST['email']}',
                     '{$_POST['direccion']}','{$_POST['telefono']}')";
  }

  if ($_POST['accion'] == 'donacion') {
      $sql = "INSERT INTO DONACION(monto,fecha,id_proyecto,id_donante)
              VALUES({$_POST['monto']},CURDATE(),{$_POST['proyecto']},{$_POST['donante']})";
  }

  mysqli_query($cn,$sql);
  header("Location: panel.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><title>Panel</title></head>
<body>
<h2>Nuevo Proyecto</h2>
<form method="post">
  <input type="hidden" name="accion" value="proyecto">
  Nombre: <input name="nombre"><br>
  Descripción: <input name="descripcion"><br>
  Presupuesto: <input name="presupuesto" type="number"><br>
  Inicio: <input name="inicio" type="date">
  Fin: <input name="fin" type="date"><br>
  <button>Guardar proyecto</button>
</form>

<h2>Nuevo Donante</h2>
<form method="post">
  <input type="hidden" name="accion" value="donante">
  Nombre: <input name="nombre"><br>
  Email: <input name="email"><br>
  Dirección: <input name="direccion"><br>
  Teléfono: <input name="telefono"><br>
  <button>Guardar donante</button>
</form>

<h2>Nueva Donación</h2>
<form method="post">
  <input type="hidden" name="accion" value="donacion">
  Monto: <input name="monto" type="number"><br>

  Proyecto:
  <select name="proyecto">
    <?php
      $p = mysqli_query($cn,"SELECT id,nombre FROM PROYECTO");
      while($r=mysqli_fetch_assoc($p)){ echo "<option value='{$r['id']}'>{$r['nombre']}</option>"; }
    ?>
  </select><br>

  Donante:
  <select name="donante">
    <?php
      $d = mysqli_query($cn,"SELECT id,nombre FROM DONANTE");
      while($r=mysqli_fetch_assoc($d)){ echo "<option value='{$r['id']}'>{$r['nombre']}</option>"; }
    ?>
  </select><br>

  <button>Registrar donación</button>
</form>

<hr>
<h3>Registros</h3>
<?php
echo "<strong>Proyectos:</strong><br>";
$r=mysqli_query($cn,"SELECT * FROM PROYECTO"); while($f=mysqli_fetch_assoc($r)){echo $f['id']." - ".$f['nombre']."<br>";}
echo "<strong>Donantes:</strong><br>";
$r=mysqli_query($cn,"SELECT * FROM DONANTE"); while($f=mysqli_fetch_assoc($r)){echo $f['id']." - ".$f['nombre']."<br>";}
echo "<strong>Donaciones:</strong><br>";
$r=mysqli_query($cn,"SELECT * FROM DONACION"); while($f=mysqli_fetch_assoc($r)){
 echo $f['id']." : $".$f['monto']." al proyecto ".$f['id_proyecto']." por donante ".$f['id_donante']."<br>";
}
?>
</body></html>