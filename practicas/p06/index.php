<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba de Funciones</title>
</head>
<body>
    <h1>Resultados de las Funciones</h1>

    <?php
    include 'src/funciones.php';

    // Ejercicio 1: Comprobar si un número es múltiplo de 5 y 7
    echo "<h2>Ejercicio 1: Comprobar si un número es múltiplo de 5 y 7</h2>";
    if (isset($_GET['numero'])) {
        $numero = intval($_GET['numero']);
        if (esMultiploDe5y7($numero)) {
            echo "<p>El número $numero <strong>es</strong> múltiplo de 5 y 7.</p>";
        } else {
            echo "<p>El número $numero <strong>no es</strong> múltiplo de 5 y 7.</p>";
        }
    } else {
        echo "<p>Por favor, proporciona un número en la URL. Ejemplo: ?numero=35</p>";
    }

    // Ejercicio 2: Generar secuencia impar, par, impar
    echo "<h2>Ejercicio 2: Generar secuencia impar, par, impar</h2>";
    $resultado = generarMatriz();
    $matriz = $resultado['matriz'];
    $iteraciones = $resultado['iteraciones'];
    $numerosGenerados = $resultado['numerosGenerados'];

    // Matriz
    echo "<h3>Matriz generada:</h3>";
    echo "<table border='1'>";
    foreach ($matriz as $fila) {
        echo "<tr>";
        foreach ($fila as $numero) {
            echo "<td>$numero</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<p>Números generados: $numerosGenerados</p>";
    echo "<p>Iteraciones realizadas: $iteraciones</p>";

    // Ejercicio 3: Encontrar el primer número aleatorio múltiplo de un número dado
    echo "<h2>Ejercicio 3: Encontrar el primer número aleatorio múltiplo de un número dado</h2>";
    if (isset($_GET['numeroDado'])) {
        $numeroDado = intval($_GET['numeroDado']);

        // Usando while
        $resultadoWhile = encontrarMultiploConWhile($numeroDado);
        echo "<h3>Usando while:</h3>";
        echo "<p>Número encontrado: {$resultadoWhile['numero']}</p>";
        echo "<p>Intentos realizados: {$resultadoWhile['intentos']}</p>";

        // Usando do-while
        $resultadoDoWhile = encontrarMultiploConDoWhile($numeroDado);
        echo "<h3>Usando do-while:</h3>";
        echo "<p>Número encontrado: {$resultadoDoWhile['numero']}</p>";
        echo "<p>Intentos realizados: {$resultadoDoWhile['intentos']}</p>";
    } else {
        echo "<p>Por favor, proporciona un número en la URL. Ejemplo: ?numeroDado=7</p>";
    }
    ?>
</body>
</html>