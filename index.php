<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Estudiantes</title>

<style>
/* --- Ajustes Globales Modernos --- */
body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background: #f8fafc; /* Gris ultra claro y limpio */
    color: #1e293b; /* Gris oscuro para mejor lectura */
    padding: 40px 20px;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    box-sizing: border-box;
}

/* --- Contenedor Principal (Tarjeta) --- */
.container {
    width: 100%;
    max-width: 550px;
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

/* --- Formulario y Etiquetas --- */
label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 6px;
}

input {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 20px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background-color: #f8fafc;
    font-size: 15px;
    color: #334155;
    box-sizing: border-box;
    transition: all 0.2s ease;
}

input:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
}

/* Estilo especial para el input file */
input[type="file"] {
    background: #ffffff;
    padding: 10px;
    cursor: pointer;
    border: 2px dashed #cbd5e1;
}

input[type="file"]:hover {
    border-color: #3b82f6;
}

/* --- Botón de Enviar --- */
button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.1s ease, opacity 0.2s ease;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

button:hover {
    opacity: 0.95;
}

button:active {
    transform: scale(0.98);
}

/* --- Separador --- */
hr {
    border: 0;
    height: 1px;
    background: #e2e8f0;
    margin: 32px 0;
}

/* --- Menú de Navegación inferior --- */
.menu {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.menu a {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    background: #f1f5f9;
    color: #334155;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.menu a:hover {
    background: #e2e8f0;
    color: #0f172a;
    transform: translateX(4px);
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
