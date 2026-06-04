<?php

$archivo = "estudiantes.json";

if(!file_exists($archivo))
{
    die("No existen estudiantes registrados");
}

$estudiantes = json_decode(
file_get_contents($archivo),
true
);

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Listado</title>
</head>

<body>

<h1>📋 Estudiantes Registrados</h1>

<table border="1" cellpadding="10">

<tr>
<th>Nombre</th>
<th>Documento</th>
<th>Correo</th>
<th>Fecha</th>
</tr>

<?php

foreach($estudiantes as $e)
{
    echo "

    <tr>

    <td>{$e['nombre']}</td>

    <td>{$e['documento']}</td>

    <td>{$e['correo']}</td>

    <td>{$e['fecha']}</td>

    </tr>

    ";
}

?>

</table>

<br>

<a href="index.php">
🏠 Volver
</a>

</body>
</html>
