<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo = __DIR__ . "estudiantes.json";

if (!file_exists($archivo))
{
    die("
    <h2 style='color:red'>
    ❌ No existe el archivo estudiantes.json
    </h2>
    ");
}

$contenido = file_get_contents($archivo);

$estudiantes = json_decode($contenido, true);

if ($estudiantes === null)
{
    die("
    <h2 style='color:red'>
    ❌ Error en el formato de estudiantes.json
    </h2>

    <h3>Contenido encontrado:</h3>

    <pre>" . htmlspecialchars($contenido) . "</pre>
    ");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Listado de Estudiantes</title>

<style>

body{
    font-family: Arial, sans-serif;
    margin: 20px;
}

table{
    border-collapse: collapse;
    width: 100%;
}

th, td{
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

th{
    background: #f2f2f2;
}

.sin-registros{
    color: orange;
    font-size: 18px;
}

</style>

</head>

<body>

<h1>📋 Estudiantes Registrados</h1>

<?php

if (count($estudiantes) == 0)
{
    echo "
    <p class='sin-registros'>
    ⚠ No hay estudiantes registrados
    </p>
    ";
}
else
{
?>

<table>

<tr>
    <th>Nombre</th>
    <th>Documento</th>
    <th>Correo</th>
    <th>Fecha</th>
</tr>

<?php

foreach ($estudiantes as $e)
{
    echo "

    <tr>

        <td>" . htmlspecialchars($e['nombre']) . "</td>

        <td>" . htmlspecialchars($e['documento']) . "</td>

        <td>" . htmlspecialchars($e['correo']) . "</td>

        <td>" . htmlspecialchars($e['fecha']) . "</td>

    </tr>

    ";
}

?>

</table>

<?php
}
?>

<br><br>

<a href="index.php">
🏠 Volver al inicio
</a>

</body>
</html>
