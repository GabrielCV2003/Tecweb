<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

<h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$a = "ManejadorSQL";<br />
       $b = 'MySQL';<br />
       $c = &$a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo '<h4>Valores de las variables:</h4>';
        echo '<ul>';
        echo "<li>\$a = $a</li>";
        echo "<li>\$b = $b</li>";
        echo "<li>\$c = $c</li>";
        echo '</ul>';
    ?>

<h3>Segunda asignación de valores</h3>
    <p>$a = "PHP server";<br />
       $b = &$a;</p>
    <?php
        $a = "PHP server";
        $b = &$a;
    
        echo '<h4>Valores de las variables después de la segunda asignación:</h4>';
        echo '<ul>';
        echo "<li>\$a = $a</li>";
        echo "<li>\$b = $b</li>";
        echo "<li>\$c = $c</li>";
        echo '</ul>';

        echo '<h3>Explicación</h3>';
        echo '<p>En la segunda asignación, la variable $b ahora es una referencia a $a, por lo que cualquier cambio en $a también se refleja en $b. ';
        echo 'Sin embargo, $c sigue apuntando a su asignación original de $a, por lo que también cambia cuando $a se modifica.</p>';
    ?>

<h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglos).</p>
    <?php
        $a = "PHP5";
        echo "<p>Después de asignar \$a = 'PHP5': \$a = $a</p>";

        $z[] = &$a;
        echo "<p>Después de asignar \$z[] = &\$a: \$z[0] = {$z[0]}</p>";

        $b = "5a version de PHP";
        echo "<p>Después de asignar \$b = '5a version de PHP': \$b = $b</p>";

        // Modificado: Extraemos solo el número de $b antes de multiplicar para evitar el error
        $c = intval($b) * 10;
        echo "<p>Después de asignar \$c = intval(\$b) * 10: \$c = $c</p>";

        $a .= $b;
        echo "<p>Después de asignar \$a .= \$b: \$a = $a</p>";

        $b *= $c;
        echo "<p>Después de asignar \$b *= \$c: \$b = $b</p>";

        $z[0] = "MySQL";
        echo "<p>Después de asignar \$z[0] = 'MySQL': \$z[0] = {$z[0]}</p>";

        echo '<h3>Explicación</h3>';
        echo '<p>La variable $a inicialmente contenía "PHP5", y al asignarle una referencia en $z[0], cualquier cambio en $a se reflejaba en $z[0]. ';
        echo 'Cuando $a se concatenó con $b, su valor cambió, lo que afectó también a $z[0]. Posteriormente, al reasignar "MySQL" a $z[0], ';
        echo 'la referencia entre $a y $z[0] se rompió, por lo que ya no reflejan el mismo valor.</p>';
    ?>

<h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        global $a, $b, $c, $z;

        echo '<h4>Valores utilizando $GLOBALS:</h4>';
        echo '<ul>';
        echo "<li>\$a = ".$GLOBALS['a']."</li>";
        echo "<li>\$b = ".$GLOBALS['b']."</li>";
        echo "<li>\$c = ".$GLOBALS['c']."</li>";
        echo "<li>\$z[0] = ".$GLOBALS['z'][0]."</li>";
        echo '</ul>';

        echo '<h3>Explicación</h3>';
        echo '<p>En este ejercicio, utilizamos la matriz $GLOBALS para acceder a las variables globales desde cualquier parte del script.</p>';
    ?>

<h2>Ejercicio 5</h2>
<p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
<p>$a = "7 personas";<br />
   $b = (integer) $a;<br />
   $a = "9E3";<br />
   $c = (double) $a;</p>

<?php
    $a = "7 personas";
    $b = (integer) $a;
    echo "<h4>Valores después de cada asignación:</h4>";
    echo "<ul>";
    echo "<li>Después de (integer) \$a: \$b = "; var_dump($b); echo "</li>";

    $a = "9E3";  // PHP lo interpreta como 9000 en notación científica
    echo "<li>Después de asignar '9E3' a \$a: \$a = "; var_dump($a); echo "</li>";

    $c = (double) $a;  // Convierte "9E3" a 9000.0
    echo "<li>Después de (double) \$a: \$c = "; var_dump($c); echo "</li>";
    echo "</ul>";
?>

<h2>Ejercicio 6</h2>
<p>Comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f usando var_dump().</p>
<p>Después, transformar los valores booleanos de $c y $e en algo visible con echo.</p>

<?php
    $a = 0; 
    $b = true; 
    $c = false;
    $d = ($a || $b); 
    $e = ($a && $c);
    $f = ($a XOR $b); 

    echo "<h4>Valores Booleanos:</h4>";
    echo "<ul>";
    echo "<li>\$a = "; var_dump((bool)$a); echo "</li>"; // Se evalúa como false
    echo "<li>\$b = "; var_dump((bool)$b); echo "</li>"; // Se evalúa como true
    echo "<li>\$c = "; var_dump((bool)$c); echo "</li>"; // Se evalúa como false
    echo "<li>\$d = "; var_dump((bool)$d); echo "</li>"; // Se evalúa como true
    echo "<li>\$e = "; var_dump((bool)$e); echo "</li>"; // Se evalúa como false
    echo "<li>\$f = "; var_dump((bool)$f); echo "</li>"; // Se evalúa como true
    echo "</ul>";

    echo "<h4>Booleanos convertidos:</h4>";
    echo "<ul>";
    echo "<li>\$c = " . ($c ? 'true' : 'false') . "</li>"; // false
    echo "<li>\$e = " . ($e ? 'true' : 'false') . "</li>"; // false
    echo "<li>\$f = " . ($f ? 'true' : 'false') . "</li>"; // true
    echo "</ul>";

    echo "<h3>Explicación</h3>";
    echo "<p>Se cambió \$a a un número en lugar de una cadena, ya que '0' como string es false en PHP.</p>";
    echo "<p>Los operadores lógicos funcionan ahora correctamente con valores booleanos esperados.</p>";
    echo "<p>La función var_dump() permite ver los valores reales en booleano.</p>";
?>

<h2>Ejercicio 7</h2>
<p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
<ul>
    <li>a. La versión de Apache y PHP</li>
    <li>b. El nombre del sistema operativo (servidor)</li>
    <li>c. El idioma del navegador (cliente)</li>
</ul>

<?php
    echo '<h4>Resultado de $_SERVER:</h4>';
    echo '<ul>';

    // a. La versión de Apache y PHP
    echo "<li>Versión de Apache: ".$_SERVER['SERVER_SOFTWARE']."</li>";
    echo "<li>Versión de PHP: ".phpversion()."</li>"; // Usamos phpversion() para obtener la versión de PHP

    // b. El nombre del sistema operativo (servidor)
    echo "<li>Sistema operativo del servidor: ".php_uname()."</li>"; // php_uname() devuelve información sobre el sistema operativo del servidor

    // c. El idioma del navegador (cliente)
    echo "<li>Idioma del navegador (cliente): ".$_SERVER['HTTP_ACCEPT_LANGUAGE']."</li>"; // $_SERVER['HTTP_ACCEPT_LANGUAGE'] devuelve el idioma preferido del navegador

    echo '</ul>';

    echo '<h3>Explicación</h3>';
    echo '<p>La variable predefinida $_SERVER nos permite obtener información sobre el servidor y el cliente. En este caso, usamos:</p>';
    echo '<ul>';
    echo '<li><b>$_SERVER[\'SERVER_SOFTWARE\']</b> para obtener la versión del servidor web (Apache).</li>';
    echo '<li><b>phpversion()</b> para obtener la versión de PHP instalada en el servidor.</li>';
    echo '<li><b>php_uname()</b> para obtener información sobre el sistema operativo del servidor.</li>';
    echo '<li><b>$_SERVER[\'HTTP_ACCEPT_LANGUAGE\']</b> para obtener el idioma preferido del cliente según la configuración de su navegador.</li>';
    echo '</ul>';
?>

</body>
</html>