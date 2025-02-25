<?php
header('Content-Type: application/xhtml+xml; charset=UTF-8');

// Verificar si se proporciona un ID en la URL
if (!isset($_GET['id'])) {
    die('<p>Error: No se proporcionó un ID de producto.</p>');
}

$id = intval($_GET['id']);

$host = 'localhost';
$user = 'root';
$pass = 'vallelly2003';
$db   = 'marketzone';

// Conectar a la base de datos
$link = new mysqli($host, $user, $pass, $db);

if ($link->connect_errno) {
    die('<p>Error de conexión: ' . $link->connect_error . '</p>');
}

// Consulta para obtener el producto con el ID proporcionado
$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('<p>Error: No se encontró un producto con el ID proporcionado.</p>');
}

$producto = $result->fetch_assoc();

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">';
echo '<head>';
echo '  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />';
echo '  <title>Detalles del Producto</title>';
echo '</head>';
echo '<body>';
echo '  <h1>Detalles del Producto</h1>';
echo '  <table border="1">';
echo '    <tr>';
echo '      <th>ID</th>';
echo '      <th>Nombre</th>';
echo '      <th>Marca</th>';
echo '      <th>Modelo</th>';
echo '      <th>Precio</th>';
echo '      <th>Detalles</th>';
echo '      <th>Unidades</th>';
echo '      <th>Imagen</th>';
echo '      <th>Acciones</th>'; // Columna para el botón "Editar"
echo '    </tr>';
echo '    <tr>';
echo '      <td>' . htmlspecialchars($producto['id']) . '</td>';
echo '      <td>' . htmlspecialchars($producto['nombre']) . '</td>';
echo '      <td>' . htmlspecialchars($producto['marca']) . '</td>';
echo '      <td>' . htmlspecialchars($producto['modelo']) . '</td>';
echo '      <td>$' . number_format($producto['precio'], 2) . '</td>';
echo '      <td>' . nl2br(htmlspecialchars($producto['detalles'])) . '</td>';
echo '      <td>' . (int)$producto['unidades'] . '</td>';
echo '      <td><img src="' . htmlspecialchars($producto['imagen']) . '" width="100" /></td>';
echo '      <td><a href="formulario_productos_v3.php?id=' . $producto['id'] . '">Editar</a></td>'; // Botón "Editar"
echo '    </tr>';
echo '  </table>';
echo '</body>';
echo '</html>';

// Cerrar la conexión a la base de datos
$stmt->close();
$link->close();
?>