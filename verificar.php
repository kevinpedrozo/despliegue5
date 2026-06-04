<?php

$estudiantesFile = sys_get_temp_dir() . "/estudiantes.json";
$documentosFile = sys_get_temp_dir() . "/documentos.json";

if (!file_exists($estudiantesFile)) {
    file_put_contents($estudiantesFile, "[]");
}

if (!file_exists($documentosFile)) {
    file_put_contents($documentosFile, "[]");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Verificación</title>

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
    margin-bottom: 24px;
    text-align: center;
}

/* --- Grupo de Resultados --- */
.results-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 28px;
}

/* --- Cajas de Estado (Alertas) --- */
.status-card {
    padding: 14px 18px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    display: flex;
    align-items: center;
    border: 1px solid transparent;
}

.status-success {
    background-color: #f0fdf4;
    border-color: #bbf7d0;
    color: #166534;
}

.status-danger {
    background-color: #fef2f2;
    border-color: #fca5a5;
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
    text-align: center;
}

.btn-back:hover {
    background: #e2e8f0;
    color: #0f172a;
    transform: translateY(-1px);
}

.btn-back:active {
    transform: translateY(0);
}
</style>

</head>

<body>

<div class="container">

<h1>🔍 Verificación de Almacenamiento</h1>

<div class="results-group">
<?php

foreach($estudiantes as $e)
{
    $existe = false;

    foreach($documentos as $d)
    {
        if(
        $e["documento"] ==
        $d["documento"]
        )
        {
            $existe = true;
            break;
        }
    }

    if($existe)
    {
        // Caja de éxito mejorada con CSS moderno
        echo "
        <div class='status-card status-success'>
            ✅ {$e['nombre']} almacenado en ambos soportes
        </div>
        ";
    }
    else
    {
        // Caja de error mejorada con CSS moderno
        echo "
        <div class='status-card status-danger'>
            ❌ {$e['nombre']} NO fue almacenado correctamente
        </div>
        ";
    }
}

?>
</div>

<a href="index.php" class="btn-back">
    🏠 Volver al Inicio
</a>

</div>

</body>
</html>
</a>

</body>
</html>
