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

if (
    empty($nombre) ||
    empty($documento) ||
    empty($correo)
)
{
    die("
    <h2 style='color:red'>
    ❌ Todos los campos son obligatorios
    </h2>
    <a href='index.php'>Volver</a>
    ");
}

if (!isset($_FILES["archivo"]))
{
    die("
    <h2 style='color:red'>
    ❌ No se recibió ningún archivo
    </h2>
    ");
}

if ($_FILES["archivo"]["error"] != 0)
{
    die("
    <h2 style='color:red'>
    ❌ Error al cargar archivo
    </h2>
    <pre>" . print_r($_FILES, true) . "</pre>
    ");
}

if (!file_exists("data"))
{
    mkdir("data", 0777, true);
}

if (!file_exists("uploads"))
{
    mkdir("uploads", 0777, true);
}

$estudiantesFile = "estudiantes.json";
$documentosFile = "documentos.json";

if (!file_exists($estudiantesFile))
{
    file_put_contents($estudiantesFile, "[]");
}

if (!file_exists($documentosFile))
{
    file_put_contents($documentosFile, "[]");
}

$estudiantes = json_decode(
    file_get_contents($estudiantesFile),
    true
);

if (!$estudiantes)
{
    $estudiantes = [];
}

foreach ($estudiantes as $e)
{
    if ($e["documento"] == $documento)
    {
        die("
        <h2 style='color:red'>
        ❌ Ya existe un estudiante con ese documento
        </h2>

        <a href='index.php'>
        Volver
        </a>
        ");
    }
}

$nombreArchivo = basename($_FILES["archivo"]["name"]);

$rutaArchivo =
"uploads/" .
time() .
"_" .
$nombreArchivo;

$subida = move_uploaded_file(
    $_FILES["archivo"]["tmp_name"],
    $rutaArchivo
);

if (!$subida)
{
    die("
    <h2 style='color:red'>
    ❌ Error al mover archivo al servidor
    </h2>

    <h3>Información de depuración:</h3>

    <pre>
    " . print_r($_FILES, true) . "
    </pre>

    <p>
    Verifica que exista la carpeta uploads.
    </p>
    ");
}

$nuevoEstudiante = [

    "nombre" => $nombre,
    "documento" => $documento,
    "correo" => $correo,
    "fecha" => date("Y-m-d H:i:s")

];

$estudiantes[] = $nuevoEstudiante;

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

if (!$documentos)
{
    $documentos = [];
}

$documentos[] = [

    "documento" => $documento,
    "archivo" => $rutaArchivo

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
<title>Registro Exitoso</title>
</head>

<body>

<h1 style="color:green">
✅ Registro completado
</h1>

<p>
Nombre:
<b><?php echo htmlspecialchars($nombre); ?></b>
</p>

<p>
Documento:
<b><?php echo htmlspecialchars($documento); ?></b>
</p>

<p>
Correo:
<b><?php echo htmlspecialchars($correo); ?></b>
</p>

<p>
Archivo:
<b><?php echo htmlspecialchars($rutaArchivo); ?></b>
</p>

<hr>

<h2>Verificación de almacenamiento</h2>

<ul>

<li>
<?php
echo $resultadoEstudiantes !== false
? "✅ estudiantes.json actualizado"
: "❌ Error estudiantes.json";
?>
</li>

<li>
<?php
echo $resultadoDocumentos !== false
? "✅ documentos.json actualizado"
: "❌ Error documentos.json";
?>
</li>

<li>
<?php
echo file_exists($rutaArchivo)
? "✅ Archivo almacenado"
: "❌ Archivo no encontrado";
?>
</li>

</ul>

<br>

<a href="index.php">
🏠 Volver al inicio
</a>

</body>
</html>
