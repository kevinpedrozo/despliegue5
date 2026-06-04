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

// Estilo base reutilizable para los errores críticos
$estiloError = "font-family:system-ui, sans-serif; max-width:500px; margin:50px auto; padding:30px; background:#fef2f2; border:1px solid #fca5a5; color:#991b1b; border-radius:16px; text-align:center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);";
$estiloBotonError = "display:inline-block; margin-top:20px; padding:10px 20px; background:#991b1b; color:white; text-decoration:none; border-radius:8px; font-weight:600;";

if(empty($nombre) || empty($documento) || empty($correo))
{
    die("<div style='{$estiloError}'><h2>❌ Todos los campos son obligatorios</h2><a href='index.php' style='{$estiloBotonError}'>Volver</a></div>");
}

// Se definen las rutas correctas apuntando a la carpeta temporal (evita el Permission Denied)
$estudiantesFile = sys_get_temp_dir() . "/estudiantes.json";
$documentosFile = sys_get_temp_dir() . "/documentos.json";

// Si el archivo de estudiantes no existe o está vacío, creamos los registros iniciales
if (!file_exists($estudiantesFile) || empty(file_get_contents($estudiantesFile)) || file_get_contents($estudiantesFile) === "[]") {
    $datosInicialesEstudiantes = [
        [
            "nombre" => "Carlos Mendoza",
            "documento" => "10203040",
            "correo" => "carlos.mendoza@email.com",
            "fecha" => date("Y-m-d H:i:s")
        ],
        [
            "nombre" => "Ana Maria Restrepo",
            "documento" => "50607080",
            "correo" => "ana.restrepo@email.com",
            "fecha" => date("Y-m-d H:i:s")
        ],
        [
            "nombre" => "Laura Sofia Gomez",
            "documento" => "90807060",
            "correo" => "laura.gomez@email.com",
            "fecha" => date("Y-m-d H:i:s")
        ]
    ];
    file_put_contents($estudiantesFile, json_encode($datosInicialesEstudiantes, JSON_PRETTY_PRINT));
}

// Si el archivo de documentos no existe o está vacío, creamos los registros iniciales
if (!file_exists($documentosFile) || empty(file_get_contents($documentosFile)) || file_get_contents($documentosFile) === "[]") {
    $datosInicialesDocumentos = [
        [
            "documento" => "10203040",
            "archivo" => "1717400000_documento_carlos.pdf"
        ],
        [
            "documento" => "50607080",
            "archivo" => "1717411111_documento_ana.pdf"
        ]
    ];
    file_put_contents($documentosFile, json_encode($datosInicialesDocumentos, JSON_PRETTY_PRINT));
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
        <div style='{$estiloError}'>
            <h2>❌ El estudiante ya existe</h2>
            <a href='index.php' style='{$estiloBotonError}'>Volver al Inicio</a>
        </div>
        ");
    }
}

// Carpeta de subidas dentro de la carpeta temporal para evitar bloqueos de permisos en Render
$subidasCarpeta = sys_get_temp_dir() . "/uploads";
if(!file_exists($subidasCarpeta))
{
    mkdir($subidasCarpeta, 0777, true);
}

$nombreArchivo =
time() . "_" .
basename($_FILES["archivo"]["name"]);

$rutaFisica =
$subidasCarpeta . "/" .
$nombreArchivo;

if(!move_uploaded_file(
    $_FILES["archivo"]["tmp_name"],
    $rutaFisica
))
{
    die("<div style='{$estiloError}'><h2>❌ Error al subir archivo</h2><a href='index.php' style='{$estiloBotonError}'>Volver</a></div>");
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
<title>Registro Exitoso</title>

<style>
/* --- Ajustes Globales --- */
body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background: #f8fafc;
    color: #1e293b;
    padding: 40px 20px;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    box-sizing: border-box;
}

/* --- Contenedor Principal --- */
.container {
    width: 100%;
    max-width: 550px;
    background: #ffffff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* --- Encabezado de Éxito --- */
.success-header {
    background-color: #f0fdf4;
    border: 1px solid #bbf7d0;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 28px;
}

.success-header h1 {
    color: #16a34a;
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}

/* --- Lista de Detalles del Estudiante --- */
.details-box {
    text-align: left;
    background: #f8fafc;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    margin-bottom: 24px;
}

.details-box p {
    margin: 10px 0;
    font-size: 15px;
    color: #334155;
}

.details-box p b {
    color: #0f172a;
    display: inline-block;
    width: 100px;
}

/* --- Separador --- */
hr {
    border: 0;
    height: 1px;
    background: #e2e8f0;
    margin: 24px 0;
}

/* --- Badges / Etiquetas de Estado --- */
.status-badge {
    display: block;
    padding: 10px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    text-align: left;
}

.status-ok {
    background-color: #f0fdf4;
    color: #166534;
}

.status-error {
    background-color: #fef2f2;
    color: #991b1b;
}

/* --- Botón Volver --- */
.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background: #f1f5f9;
    color: #334155;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid #cbd5e1;
    width: 100%;
    box-sizing: border-box;
    margin-top: 16px;
}

.btn-back:hover {
    background: #e2e8f0;
    color: #0f172a;
    transform: translateY(-1px);
}
</style>

</head>

<body>

<div class="container">

    <div class="success-header">
        <h1>✅ Registro Completado con Éxito</h1>
    </div>

    <div class="details-box">
        <p><b>Nombre:</b> <?= htmlspecialchars($nombre) ?></p>
        <p><b>Documento:</b> <?= htmlspecialchars($documento) ?></p>
        <p><b>Correo:</b> <?= htmlspecialchars($correo) ?></p>
    </div>

    <hr>

    <div class="status-badge <?= $resultadoEstudiantes !== false ? 'status-ok' : 'status-error'; ?>">
        <?= $resultadoEstudiantes !== false ? "✅ Base de estudiantes actualizada correctamente" : "❌ Error al guardar datos del estudiante"; ?>
    </div>

    <div class="status-badge <?= $resultadoDocumentos !== false ? 'status-ok' : 'status-error'; ?>">
        <?= $resultadoDocumentos !== false ? "✅ Base de documentos actualizada correctamente" : "❌ Error al guardar datos del documento"; ?>
    </div>

    <a href="index.php" class="btn-back">🏠 Volver al Inicio</a>

</div>

</body>
</html>
