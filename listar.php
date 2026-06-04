<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definimos la ruta en la carpeta temporal para evitar problemas de permisos
$archivo = sys_get_temp_dir() . "/estudiantes.json";

// Si el archivo no existe, está vacío o solo contiene "[]", cargamos los registros iniciales
if (!file_exists($archivo) || empty(file_get_contents($archivo)) || file_get_contents($archivo) === "[]") {
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
    file_put_contents($archivo, json_encode($datosInicialesEstudiantes, JSON_PRETTY_PRINT));
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
    max-width: 800px;
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

/* --- Contenedor de Tabla Responsiva --- */
.table-container {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 24px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

/* --- Estilos de la Tabla --- */
table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 15px;
}

th {
    background-color: #0f172a;
    color: #ffffff;
    padding: 14px 16px;
    font-weight: 600;
}

td {
    padding: 14px 16px;
    color: #334155;
    border-bottom: 1px solid #e2e8f0;
    background-color: #ffffff;
}

tr:last-child td {
    border-bottom: none;
}

tr:hover td {
    background-color: #f8fafc;
}

/* --- Alerta de No Hay Estudiantes --- */
.alert-empty {
    background-color: #fffbeb;
    border: 1px solid #fef3c7;
    color: #b45309;
    padding: 16px;
    border-radius: 8px;
    text-align: center;
    font-weight: 500;
    margin-bottom: 24px;
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

<h1>📋 Estudiantes Registrados</h1>

<?php if(count($estudiantes) == 0){ ?>

<div class="alert-empty">
    ⚠ No hay estudiantes registrados actualmente.
</div>

<?php } else { ?>

<div class="table-container">
    <table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($estudiantes as $e){ ?>
        <tr>
            <td><?= htmlspecialchars($e['nombre']) ?></td>
            <td><?= htmlspecialchars($e['documento']) ?></td>
            <td><?= htmlspecialchars($e['correo']) ?></td>
            <td><?= htmlspecialchars($e['fecha']) ?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
</div>

<?php } ?>

<a href="index.php" class="btn-back">🏠 Volver al Inicio</a>

</div>

</body>
</html>
