<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once("../../config/db.php");

try {
    $stmt = $conn->query("SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.stock, c.nombre AS categoria
                          FROM productos p
                          LEFT JOIN categorias c ON p.id_categoria = c.id_categoria");

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "data" => $productos
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Error al obtener productos",
        "error" => $e->getMessage()
    ]);
}
