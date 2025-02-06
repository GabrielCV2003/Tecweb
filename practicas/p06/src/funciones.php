<?php

// Función para verificar si un número es múltiplo de 5 y 7
function esMultiploDe5y7($numero) {
    if ($numero % 5 == 0 && $numero % 7 == 0) {
        return true;
    } else {
        return false;
    }
}

function generarSecuencia() {
    $secuencia = [];
    for ($i = 0; $i < 3; $i++) {
        $secuencia[] = rand(100, 999);
    }
    return $secuencia;
}

// Función para verificar si una secuencia cumple con el patrón impar, par, impar (Ejercicio 2)
function cumplePatron($secuencia) {
    return ($secuencia[0] % 2 != 0) && 
           ($secuencia[1] % 2 == 0) && 
           ($secuencia[2] % 2 != 0); 
}

// Función principal para resolver el ejercicio 2
function generarMatriz() {
    $matriz = [];
    $iteraciones = 0;
    $numerosGenerados = 0;

    do {
        $secuencia = generarSecuencia();
        $matriz[] = $secuencia; // Almacenar la secuencia en la matriz
        $iteraciones++;
        $numerosGenerados += 3; // Cada secuencia tiene 3 números
    } while (!cumplePatron($secuencia)); // Repetir hasta que se cumpla el patrón

    return [
        'matriz' => $matriz,
        'iteraciones' => $iteraciones,
        'numerosGenerados' => $numerosGenerados
    ];
}

// Función para encontrar el primer número aleatorio múltiplo de un número dado usando while (Ejercicio 3)
function encontrarMultiploConWhile($numeroDado) {
    $encontrado = false;
    $intentos = 0;

    while (!$encontrado) {
        $numeroAleatorio = rand(1, 1000); // Número aleatorio entre 1 y 1000
        $intentos++;

        if ($numeroAleatorio % $numeroDado == 0) {
            $encontrado = true;
            return [
                'numero' => $numeroAleatorio,
                'intentos' => $intentos
            ];
        }
    }
}

// Función para encontrar el primer número aleatorio múltiplo de un número dado usando do-while (Ejercicio 3)
function encontrarMultiploConDoWhile($numeroDado) {
    $encontrado = false;
    $intentos = 0;

    do {
        $numeroAleatorio = rand(1, 1000); // Número aleatorio entre 1 y 1000
        $intentos++;

        if ($numeroAleatorio % $numeroDado == 0) {
            $encontrado = true;
            return [
                'numero' => $numeroAleatorio,
                'intentos' => $intentos
            ];
        }
    } while (!$encontrado);
}

// Función para crear un arreglo con índices de 97 a 122 y valores de 'a' a 'z' (Ejercicio 4)
function crearArregloLetras() {
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i); // Usar chr() para obtener el carácter ASCII
    }
    return $arreglo;
}
?>

