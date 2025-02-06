<?php
// Obtener los valores del formulario usando la variable superglobal $_POST
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];

// Configurar el tipo de contenido como HTML
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
</head>
<body>
    <?php
    // Verificar si la persona es de sexo femenino y está en el rango de edad permitido
    if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
        echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
    } else {
        echo "<p>Lo siento, no cumple con los requisitos de edad y sexo.</p>";
    }
    ?>
</body>
</html>