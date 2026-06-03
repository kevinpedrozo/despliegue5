<?php

$estudiantes = json_decode(
file_get_contents("estudiantes.json"),
true
);

$documentos = json_decode(
file_get_contents("documentos.json"),
true
);

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Verificación</title>
</head>

<body>

<h1>
🔍 Verificación de Almacenamiento
</h1>

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
        echo "
        <p style='color:green'>
        ✅ {$e['nombre']}
        almacenado en ambos soportes
        </p>
        ";
    }
    else
    {
        echo "
        <p style='color:red'>
        ❌ {$e['nombre']}
        NO fue almacenado correctamente
        </p>
        ";
    }
}

?>

<a href="index.php">
🏠 Volver
</a>

</body>
</html>
