<?php

$estudiantes = [];
$documentos = [];

$archivoEstudiantes =
sys_get_temp_dir() . "/estudiantes.json";

$archivoDocumentos =
sys_get_temp_dir() . "/documentos.json";

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
<title>Estadísticas</title>
</head>

<body>

<h1>📊 Estadísticas</h1>

<h3>
Total estudiantes:
<?php echo $totalEstudiantes; ?>
</h3>

<h3>
Total documentos:
<?php echo $totalDocumentos; ?>
</h3>

<h3 style="color:green">
Correctos:
<?php echo $correctos; ?>
</h3>

<h3 style="color:red">
Errores:
<?php echo $errores; ?>
</h3>

<h3>
Porcentaje de éxito:
<?php echo $porcentaje; ?>%
</h3>

<a href="index.php">
🏠 Volver
</a>

</body>
</html>
