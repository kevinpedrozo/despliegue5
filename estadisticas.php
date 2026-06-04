<?php

$estudiantes = [];
$documentos = [];

$archivoEstudiantes = __DIR__ . "/estudiantes.json";
$archivoDocumentos = __DIR__ . "/documentos.json";

if(!file_exists($archivoEstudiantes))
{
    file_put_contents(
    $archivoEstudiantes,
    "[]"
    );
}

if(!file_exists($archivoDocumentos))
{
    file_put_contents(
    $archivoDocumentos,
    "[]"
    );
}

$estudiantes = json_decode(
    file_get_contents(
    $archivoEstudiantes
    ),
    true
);

$documentos = json_decode(
    file_get_contents(
    $archivoDocumentos
    ),
    true
);

if(!is_array($estudiantes))
{
    $estudiantes = [];
}

if(!is_array($documentos))
{
    $documentos = [];
}
$totalEstudiantes = count($estudiantes);
$totalDocumentos = count($documentos);

$correctos = 0;
$errores = 0;

foreach($estudiantes as $e)
{
    $encontrado = false;

    foreach($documentos as $d)
    {
        if(
        $e["documento"] ==
        $d["documento"]
        )
        {
            $encontrado = true;
            break;
        }
    }

    if($encontrado)
    {
        $correctos++;
    }
    else
    {
        $errores++;
    }
}

$porcentaje = 0;

if($totalEstudiantes > 0)
{
    $porcentaje =
    round(
    ($correctos /
    $totalEstudiantes)*100,
    2
    );
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Estadísticas del Sistema</title>

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
    max-width: 600px;
    background: #ffffff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

/* --- Título --- */
h1 {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-top: 0;
    margin-bottom: 28px;
    text-align: center;
}

/* --- Cuadrícula de Tarjetas (Grid) --- */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

.stat-card {
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    text-align: center;
}

.stat-card .label {
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.stat-card .value {
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
}

/* Variaciones de Color para Estados */
.card-success {
    background-color: #f0fdf4;
    border-color: #bbf7d0;
}
.card-success .value { color: #166534; }

.card-danger {
    background-color: #fef2f2;
    border-color: #fca5a5;
}
.card-danger .value { color: #991b1b; }

/* --- Sección de Porcentaje y Barra --- */
.progress-section {
    background: #f1f5f9;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 32px;
    text-align: center;
}

.progress-label {
    font-size: 15px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}

.progress-bar-container {
    width: 100%;
    height: 12px;
    background: #cbd5e1;
    border-radius: 999px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #10b981);
    border-radius: 999px;
    transition: width 0.5s ease-in-out;
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
    text-align: center;
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

    <h1>📊 Estadísticas del Sistema</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="label">Total Estudiantes</div>
            <div class="value"><?php echo $totalEstudiantes; ?></div>
        </div>

        <div class="stat-card">
            <div class="label">Total Documentos</div>
            <div class="value"><?php echo $totalDocumentos; ?></div>
        </div>

        <div class="stat-card card-success">
            <div class="label">Correctos</div>
            <div class="value"><?php echo $correctos; ?></div>
        </div>

        <div class="stat-card card-danger">
            <div class="label">Errores</div>
            <div class="value"><?php echo $errores; ?></div>
        </div>
    </div>

    <div class="progress-section">
        <div class="progress-label">
            <span>Porcentaje de éxito</span>
            <strong><?php echo $porcentaje; ?>%</strong>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar-fill" style="width: <?php echo $porcentaje; ?>%;"></div>
        </div>
    </div>

    <a href="index.php" class="btn-back">
        🏠 Volver al Inicio
    </a>

</div>

</body>
</html>
