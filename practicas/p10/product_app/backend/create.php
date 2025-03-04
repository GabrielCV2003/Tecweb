<?php
header('Content-Type: application/json');
include_once __DIR__.'/database.php';

$inputJSON = file_get_contents("php://input");
error_log("JSON recibido: " . $inputJSON);
file_put_contents(__DIR__."/debug.log", $inputJSON);

$data = json_decode($inputJSON, true);

if (!$data) {
    echo json_encode(["error" => "No se recibieron los datos necesarios.", "debug" => $inputJSON]);
    exit;
}

// Verificar que los datos esenciales están presentes
if (!isset($data['nombre']) || !isset($data['precio']) || !isset($data['modelo']) || !isset($data['marca'])) {
    echo json_encode(["error" => "Faltan datos requeridos."]);
    exit;
}

// Obtener valores del producto
$nombre = $data['nombre'];
$precio = floatval($data['precio']);
$unidades = isset($data['unidades']) ? intval($data['unidades']) : 0;
$modelo = $data['modelo'];
$marca = $data['marca'];
$detalles = isset($data['detalles']) ? $data['detalles'] : '';
$imagen = isset($data['imagen']) ? $data['imagen'] : 'img/default.png';

//Verificar si el producto ya existe en la base de datos
$verificarSQL = "SELECT id FROM productos WHERE nombre = ? AND modelo = ? AND marca = ?";
$stmtVerificar = $conexion->prepare($verificarSQL);
$stmtVerificar->bind_param('sss', $nombre, $modelo, $marca);
$stmtVerificar->execute();
$stmtVerificar->store_result();

if ($stmtVerificar->num_rows > 0) {
    echo json_encode(["error" => "El producto ya existe en la base de datos."]);
    $stmtVerificar->close();
    $conexion->close();
    exit;
}

$stmtVerificar->close();

// Si no existe, proceder a la inserción
$sql = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('sdissss', $nombre, $precio, $unidades, $modelo, $marca, $detalles, $imagen);

if ($stmt->execute()) {
    echo json_encode(["mensaje" => "Producto agregado correctamente"]);
} else {
    echo json_encode(["error" => "Error al insertar el producto"]);
}

$stmt->close();
$conexion->close();
?>
