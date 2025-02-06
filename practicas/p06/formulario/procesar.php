<?php
// Obtener los valores del formulario usando la variable superglobal $_POST
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];

// Configurar el tipo de contenido como XHTML
header('Content-Type: application/xhtml+xml; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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