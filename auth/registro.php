<?php
include("../config/db.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $estado = 1; // 1 = activo por defecto

    // Validar si ya existe el usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :usuario");
    $stmt->execute([":usuario" => $usuario]);

    if ($stmt->rowCount() > 0) {
        $mensaje = "El nombre de usuario ya está registrado.";
    } else {
        // Insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, clave, estado) VALUES (:usuario, :clave, :estado)");
        $stmt->execute([
            ":usuario" => $usuario,
            ":clave" => $clave, // Para producción se recomienda hashear con password_hash()
            ":estado" => $estado
        ]);
        header("Location: ../views/registro.php?registro=exito");
        $mensaje = "Usuario registrado correctamente.";
    }
}
?>