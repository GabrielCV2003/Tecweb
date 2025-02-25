<?php
header("Content-Type: application/xhtml+xml; charset=utf-8");

if (!isset($_GET['tope'])) {
    die('<p>Parámetro "tope" no detectado...</p>');
}

$tope = intval($_GET['tope']); // Convertir a entero para seguridad
$data = array();

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'vallelly2003', 'marketzone');

/** Comprobar la conexión */
if ($link->connect_errno) {
    die('<p>Falló la conexión: ' . htmlspecialchars($link->connect_error) . '</p>');
}

/** Consultar productos con unidades menores o iguales al tope y que no estén eliminados */
$sql = "SELECT * FROM productos WHERE unidades <= ? AND eliminado = 0";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $tope);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}

$stmt->close();
$link->close();

/** Generar XHTML **/
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Lista de Productos Vigentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
<body>
    <h3>PRODUCTOS VIGENTES</h3>
    <br/>
    <?php if (!empty($data)): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th> <!-- Nueva columna para el botón "Editar" -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $producto): ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($producto['id']); ?></th>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($producto['marca']); ?></td>
                        <td><?php echo htmlspecialchars($producto['modelo']); ?></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo htmlspecialchars($producto['unidades']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($producto['detalles'])); ?></td>
                        <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen del producto" width="100" /></td>
                        <td><a href="formulario_productos_v3.php?id=<?php echo $producto['id']; ?>">Editar</a></td> <!-- Botón "Editar" -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <script>
            alert('No hay productos que cumplan con el criterio.');
        </script>
    <?php endif; ?>
</body>
</html>