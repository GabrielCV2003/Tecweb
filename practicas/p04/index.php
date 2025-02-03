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

</body>
</html>