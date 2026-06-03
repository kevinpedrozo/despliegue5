<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Estudiantes</title>

<style>

body{
    font-family: Arial;
    background:#f4f4f4;
    padding:20px;
}

.container{
    max-width:700px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    padding:10px 20px;
    cursor:pointer;
}

.menu a{
    display:block;
    margin:10px 0;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<h1>🎓 Registro de Estudiantes</h1>

<form action="guardar.php" method="POST" enctype="multipart/form-data">

<label>Nombre</label>
<input type="text" name="nombre" required>

<label>Documento</label>
<input type="text" name="documento" required>

<label>Correo</label>
<input type="email" name="correo" required>

<label>Documento PDF</label>
<input type="file" name="archivo" required>

<button type="submit">
Registrar
</button>

</form>

<hr>

<div class="menu">

<a href="listar.php">📋 Ver Estudiantes</a>

<a href="verificar.php">
🔍 Verificar Almacenamiento
</a>

<a href="estadisticas.php">
📊 Estadísticas
</a>

</div>

</div>

</body>
</html>