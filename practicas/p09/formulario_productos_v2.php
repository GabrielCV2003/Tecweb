<?php
// Verificar si se proporciona un ID para editar
if (!isset($_GET['id'])) {
    die('<p>Error: No se proporcionó un ID de producto.</p>');
}

$id = intval($_GET['id']); // Convertir el ID a entero para seguridad

// Cargar los datos del producto desde la base de datos
$host = 'localhost';
$user = 'root';
$pass = 'vallelly2003';
$db   = 'marketzone';

$link = new mysqli($host, $user, $pass, $db);

if ($link->connect_errno) {
    die('<p>Error de conexión: ' . $link->connect_error . '</p>');
}

$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('<p>Error: No se encontró un producto con el ID proporcionado.</p>');
}

$producto = $result->fetch_assoc();

$stmt->close();
$link->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - FIKY-GAMES</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .store-title {
            font-size: 4em;
            color: #ff6600;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: glow 1.5s infinite alternate;
        }
        @keyframes glow {
            from {
                text-shadow: 2px 2px 4px rgba(255, 102, 0, 0.7);
            }
            to {
                text-shadow: 2px 2px 20px rgba(255, 102, 0, 1);
            }
        }
        h1 {
            text-align: center;
            color: #ff6600;
            font-size: 2em;
            margin-bottom: 20px;
        }
        form {
            background-color: #2d2d2d;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 100%;
        }
        fieldset {
            border: 2px solid #ff6600;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        legend {
            color: #ff6600;
            font-weight: bold;
            font-size: 1.2em;
            padding: 0 10px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #ffffff;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #3d3d3d;
            color: #ffffff;
            font-size: 1em;
        }
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
            border-color: #ff6600;
            outline: none;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            background-color: #ff6600;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #e65c00;
        }
        input[type="reset"] {
            background-color: #444;
        }
        input[type="reset"]:hover {
            background-color: #666;
        }
        .char-count {
            font-size: 0.8em;
            color: #ff6600;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="store-title">FIKY-GAMES</div>
    <form id="formularioProductos" action="http://localhost:8080/tecweb/practicas/p09/set_producto_v2.php" method="post" onsubmit="return validarFormulario()">
        <h1>Editar Producto</h1>
        <fieldset>
            <legend>FRIKY-GAMES (Videojuegos y más)</legend>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required maxlength="100" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <div class="char-count">Máximo 100 caracteres permitidos.</div>

            <label for="marca">Marca:</label>
            <select id="marca" name="marca" required>
                <option value="Sony" <?php echo ($producto['marca'] === 'Sony') ? 'selected' : ''; ?>>Sony</option>
                <option value="Microsoft" <?php echo ($producto['marca'] === 'Microsoft') ? 'selected' : ''; ?>>Microsoft</option>
                <option value="Nintendo" <?php echo ($producto['marca'] === 'Nintendo') ? 'selected' : ''; ?>>Nintendo</option>
                <option value="Otra" <?php echo ($producto['marca'] === 'Otra') ? 'selected' : ''; ?>>Otra</option>
            </select>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required maxlength="25" pattern="[A-Za-z0-9]+" value="<?php echo htmlspecialchars($producto['modelo']); ?>">
            <div class="char-count">Máximo 25 caracteres alfanuméricos permitidos.</div>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required min="100" value="<?php echo htmlspecialchars($producto['precio']); ?>">
            <div class="char-count">El precio debe ser mayor a 99.99.</div>

            <label for="detalles">Detalles:</label>
            <textarea id="detalles" name="detalles" rows="4" maxlength="250"><?php echo htmlspecialchars($producto['detalles']); ?></textarea>
            <div class="char-count">Máximo 250 caracteres permitidos.</div>

            <label for="unidades">Unidades:</label>
            <input type="number" id="unidades" name="unidades" required min="0" value="<?php echo htmlspecialchars($producto['unidades']); ?>">
            <div class="char-count">Las unidades deben ser mayores o iguales a 0.</div>

            <label for="imagen">Imagen (URL):</label>
            <input type="text" id="imagen" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
            <div class="char-count">Opcional. Si no se proporciona, se usará una imagen por defecto.</div>
        </fieldset>

        <input type="submit" value="Actualizar Producto">
        <input type="reset" value="Restablecer Valores">
    </form>

    <script>
        function validarFormulario() {
            const nombre = document.getElementById('nombre').value;
            const marca = document.getElementById('marca').value;
            const modelo = document.getElementById('modelo').value;
            const precio = document.getElementById('precio').value;
            const detalles = document.getElementById('detalles').value;
            const unidades = document.getElementById('unidades').value;
            const imagen = document.getElementById('imagen').value;

            if (nombre.length > 100) {
                alert("El nombre no puede tener más de 100 caracteres.");
                return false;
            }

            if (marca === "") {
                alert("Por favor, seleccione una marca.");
                return false;
            }

            if (modelo.length > 25 || !/^[A-Za-z0-9]+$/.test(modelo)) {
                alert("El modelo debe ser alfanumérico y tener 25 caracteres o menos.");
                return false;
            }

            if (parseFloat(precio) <= 99.99) {
                alert("El precio debe ser mayor a 99.99.");
                return false;
            }

            if (detalles.length > 250) {
                alert("Los detalles no pueden tener más de 250 caracteres.");
                return false;
            }

            if (parseInt(unidades) < 0) {
                alert("Las unidades deben ser un número mayor o igual a 0.");
                return false;
            }

            // Validación de la imagen (opcional)
            if (imagen === "") {
                document.getElementById('imagen').value = "http://localhost:8080/tecweb/practicas/p09/img/imagen.png";
            }

            return true;
        }
    </script>
</body>
</html>