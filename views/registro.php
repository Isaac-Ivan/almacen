

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>
    <h2>Registrar nuevo usuario</h2>
    <form method="POST" action="../auth/registro.php">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="clave" required><br><br>
        <button type="submit">Registrar</button>
    </form>
    <?php if (isset($_GET['registro'])) {
        $mensaje = $_GET['registro'] == 'exito' ? "Usuario registrado correctamente." : "";
        echo "<p style='color:blue;'>$mensaje</p>";
    } ?>
    <p><a href="login.php">Volver al login</a></p>
</body>
</html>
