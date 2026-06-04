<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo = "estudiantes.json";

echo "<h3>Archivo: $archivo</h3>";

if (!file_exists($archivo)) {
    die("❌ No existe estudiantes.json");
}

$contenido = file_get_contents($archivo);

echo "<h3>Contenido:</h3>";
echo "<pre>";
echo htmlspecialchars($contenido);
echo "</pre>";

$estudiantes = json_decode($contenido, true);

echo "<h3>Total registros: " . count($estudiantes) . "</h3>";

foreach ($estudiantes as $e) {
    echo "<p>";
    echo $e['nombre'] . " - ";
    echo $e['documento'] . " - ";
    echo $e['correo'];
    echo "</p>";
}
