<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include_once("../../config/db.php");

$input = json_decode(file_get_contents("php://input"), true);

if (
    !isset($input['id_producto']) ||
    !isset($input['nombre']) ||
    !isset($input['precio']) ||
    !isset($input['stock'])
) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos."]);
    exit;
}

try {
    $stmt = $conn->prepare("UPDATE productos 
        SET nombre = ?, descripcion = ?, precio = ?, stock = ?, id_categoria = ?
        WHERE id_producto = ?");

    $stmt->execute([
        $input['nombre'],
        $input['descripcion'] ?? '',
        $input['precio'],
        $input['stock'],
        $input['id_categoria'] ?? null,
        $input['id_producto']
    ]);

    echo json_encode(["status" => "success", "message" => "Producto actualizado correctamente."]);
} catch (PDOException $e) {
    echo json_encode(
        [
            "status" => "error",
            "message" => "Error al actualizar.",
            "error" => $e->getMessage()
        ]
    );
}
