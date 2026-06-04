<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$archivo = sys_get_temp_dir() . "/prueba.txt";

$resultado = file_put_contents(
    $archivo,
    "Hola desde Render - " . date("Y-m-d H:i:s")
);

echo "<h2>Prueba de escritura en Render</h2>";

echo "<p><b>Carpeta temporal:</b> " . sys_get_temp_dir() . "</p>";

echo "<p><b>Archivo:</b> " . $archivo . "</p>";

if ($resultado !== false)
{
    echo "<h3 style='color:green'>
    ✅ Se pudo escribir el archivo
    </h3>";

    echo "<pre>";
    echo file_get_contents($archivo);
    echo "</pre>";
}
else
{
    echo "<h3 style='color:red'>
    ❌ No se pudo escribir el archivo
    </h3>";
}
?>