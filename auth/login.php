<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND clave = :clave");
    $stmt->execute([
        ":usuario" => $usuario,
        ":clave" => $clave
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["usuario"] = $user["nombre_usuario"];
        header("Location: ../views/dashboard.php");
    } else {
        $error = "Usuario o clave incorrectos";
    }
}
?>
