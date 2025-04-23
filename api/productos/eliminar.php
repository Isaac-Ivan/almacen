<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include_once("../../config/db.php");
$input = json_decode(file_get_contents("php://input"), true);


// Validación mínima
if (!isset($input['id_producto']) || empty($input['id_producto'])) {
    echo json_encode(["status" => "error", "message" => "ID de producto no proporcionado."]);
    exit;
}
$stmt = $conn->query("SELECT p.id_producto FROM productos AS p");

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si el producto existe
$productoEncontrado = false;
foreach ($productos as $producto) {
    if ($producto['id_producto'] == $input['id_producto']) {
        $productoEncontrado = true;
        break;
    }
}

if ($productoEncontrado == false) {
    echo json_encode(["status" => "error", "message" => "El producto no existe."]);
    exit;
} else {
    // Eliminar el producto
    $stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = :id_producto");
    $stmt->bindParam(':id_producto', $input['id_producto']);
    if ($stmt->execute()) {
        echo json_encode(
            [
                "status" => "success",
                "message" => "Producto eliminado correctamente."
            ]
        );
    } else {
        echo json_encode(
            [
                "status" => "error",
                "message" => "Error al eliminar el producto."
            ]
        );
    }
    exit;
}
