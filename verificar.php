<?php

$archivoEstudiantes = sys_get_temp_dir() . "/estudiantes.json";
$archivoDocumentos  = sys_get_temp_dir() . "/documentos.json";

if (!file_exists($archivoEstudiantes)) {
    file_put_contents($archivoEstudiantes, "[]");
}

if (!file_exists($archivoDocumentos)) {
    file_put_contents($archivoDocumentos, "[]");
}

$estudiantes = json_decode(file_get_contents($archivoEstudiantes), true) ?? [];
$documentos  = json_decode(file_get_contents($archivoDocumentos), true) ?? [];

if (!is_array($estudiantes)) { $estudiantes = []; }
if (!is_array($documentos))  { $documentos = []; }

// OPTIMIZACIÓN: Creamos un array rápido solo con los números de documento cargados
// Esto funciona como un índice de base de datos en memoria.
$documentosCargados = array_column($documentos, 'documento');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de Registros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f8fafc;
            color: #1e293b;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: center;
        }
        th {
            background: #f1f5f9;
            color: #334155;
            font-weight: bold;
        }
        .correcto {
            color: #166534;
            font-weight: bold;
            background-color: #f0fdf4;
        }
        .error {
            color: #991b1b;
            font-weight: bold;
            background-color: #fef2f2;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>🔍 Verificación de Estudiantes</h1>

    <?php if (count($estudiantes) === 0): ?>
        <h3>No hay estudiantes registrados.</h3>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Documento</th>
                    <th>Correo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $e): ?>
                    <?php 
                        // En lugar de recorrer todos los documentos uno a uno, 
                        // preguntamos directamente si el documento existe en nuestro índice.
                        $encontrado = in_array($e["documento"], $documentosCargados); 
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($e["nombre"]) ?></td>
                        <td><?= htmlspecialchars($e["documento"]) ?></td>
                        <td><?= htmlspecialchars($e["correo"]) ?></td>
                        <?php if ($encontrado): ?>
                            <td class="correcto">✅ Documento cargado</td>
                        <?php else: ?>
                            <td class="error">❌ Sin documento</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php" class="btn-back">
        Anclaje 🏠 Volver al Inicio
    </a>

</body>
</html>
