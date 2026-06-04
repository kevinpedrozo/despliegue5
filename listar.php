<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo = __DIR__ . "/estudiantes.json";

if (!file_exists($archivo))
{
    die("<h2>❌ No existe estudiantes.json</h2>");
}

$contenido = file_get_contents($archivo);

$estudiantes = json_decode($contenido, true);

if (!is_array($estudiantes))
{
    $estudiantes = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Estudiantes</title>
</head>

<body>

<h1>📋 Estudiantes Registrados</h1>

<?php if(count($estudiantes) == 0){ ?>

<p>⚠ No hay estudiantes registrados</p>

<?php } else { ?>

<table border="1" cellpadding="10">

<tr>
<th>Nombre</th>
<th>Documento</th>
<th>Correo</th>
<th>Fecha</th>
</tr>

<?php foreach($estudiantes as $e){ ?>

<tr>
<td><?= htmlspecialchars($e['nombre']) ?></td>
<td><?= htmlspecialchars($e['documento']) ?></td>
<td><?= htmlspecialchars($e['correo']) ?></td>
<td><?= htmlspecialchars($e['fecha']) ?></td>
</tr>

<?php } ?>

</table>

<?php } ?>

<br>

<a href="index.php">🏠 Volver</a>

</body>
</html>
