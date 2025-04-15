<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="../auth/login.php">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="clave" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
