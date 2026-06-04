<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] != "POST")
{
    header("Location:index.php");
    exit();
}

$nombre = trim($_POST["nombre"] ?? "");
$documento = trim($_POST["documento"] ?? "");
$correo = trim($_POST["correo"] ?? "");

if(empty($nombre) || empty($documento) || empty($correo))
{
    die("❌ Todos los campos son obligatorios");
}

$estudiantesFile = __DIR__ . "/estudiantes.json";
$documentosFile = __DIR__ . "/documentos.json";

if(!file_exists($estudiantesFile))
{
    file_put_contents($estudiantesFile, "[]");
}

if(!file_exists($documentosFile))
{
    file_put_contents($documentosFile, "[]");
}

$estudiantes = json_decode(
    file_get_contents($estudiantesFile),
    true
);

if(!is_array($estudiantes))
{
    $estudiantes = [];
}

foreach($estudiantes as $e)
{
    if($e["documento"] == $documento)
    {
        die("
        <h2>❌ El estudiante ya existe</h2>
        <a href='index.php'>Volver</a>
        ");
    }
}

if(!file_exists(__DIR__ . "/uploads"))
{
    mkdir(__DIR__ . "/uploads", 0777, true);
}

$nombreArchivo =
time() . "_" .
basename($_FILES["archivo"]["name"]);

$rutaFisica =
__DIR__ . "/uploads/" .
$nombreArchivo;

if(!move_uploaded_file(
    $_FILES["archivo"]["tmp_name"],
    $rutaFisica
))
{
    die("❌ Error al subir archivo");
}

$estudiantes[] = [

    "nombre" => $nombre,
    "documento" => $documento,
    "correo" => $correo,
    "fecha" => date("Y-m-d H:i:s")

];

$resultadoEstudiantes = file_put_contents(
    $estudiantesFile,
    json_encode(
        $estudiantes,
        JSON_PRETTY_PRINT
    )
);

$documentos = json_decode(
    file_get_contents($documentosFile),
    true
);

if(!is_array($documentos))
{
    $documentos = [];
}

$documentos[] = [

    "documento" => $documento,
    "archivo" => $nombreArchivo

];

$resultadoDocumentos = file_put_contents(
    $documentosFile,
    json_encode(
        $documentos,
        JSON_PRETTY_PRINT
    )
);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
</head>

<body>

<h1>✅ Registro completado</h1>

<p><b>Nombre:</b> <?= htmlspecialchars($nombre) ?></p>
<p><b>Documento:</b> <?= htmlspecialchars($documento) ?></p>
<p><b>Correo:</b> <?= htmlspecialchars($correo) ?></p>

<hr>

<p>
<?= $resultadoEstudiantes !== false ? "✅ estudiantes.json actualizado" : "❌ Error estudiantes.json"; ?>
</p>

<p>
<?= $resultadoDocumentos !== false ? "✅ documentos.json actualizado" : "❌ Error documentos.json"; ?>
</p>

<br>

<a href="index.php">🏠 Volver al inicio</a>

</body>
</html>
