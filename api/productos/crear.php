<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include_once("../../config/db.php");

// Función para limpiar entradas
function limpiar($valor)
{
    return htmlspecialchars(strip_tags(trim($valor)));
}

// Obtener y decodificar datos JSON
$input = json_decode(file_get_contents("php://input"), true);

// Validación mínima
if (
    !isset($input['id_producto']) ||
    empty($input['nombre']) ||
    !isset($input['precio']) ||
    !isset($input['stock'])
) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos."]);
    exit;
}

// Limpiar y preparar los datos
$nombre = limpiar($input['nombre']);
$descripcion = isset($input['descripcion']) ? limpiar($input['descripcion']) : '';
$precio = floatval($input['precio']);
$stock = intval($input['stock']);
$id_categoria = isset($input['id_categoria']) ? intval($input['id_categoria']) : null;

try {
    $stmt = $conn->prepare("INSERT INTO productos 
        (nombre, descripcion, precio, stock, id_categoria, fecha_registro, estado) 
        VALUES (?, ?, ?, ?, ?, NOW(), 1)");

    $stmt->execute([
        $nombre,
        $descripcion,
        $precio,
        $stock,
        $id_categoria
    ]);

    echo json_encode(
        [
            "status" => "success",
            "message" => "Producto agregado correctamente."
        ]
    );
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Error al guardar.", "error" => $e->getMessage()]);
}
