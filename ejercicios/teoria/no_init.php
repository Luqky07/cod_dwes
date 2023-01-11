<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>\n");
    define("VALOR", 200);
    $a = VALOR;
    //$a = 100;
    $c = $a + $b; //$b se crea en el momento pero no se le ha asignado valor, el valor que toma por defecto es el 0
    /*
    echo "\$c tiene el valor de: " . $c . "<br/>\n";
    echo "\$b tiene el valor de: " . $b . "<br/>\n";
    echo gettype($b) . "<br/>\n";
    */
    $f = 3.2;
    var_dump($f);
    echo BR.gettype($f);
    ?>
</body>

</html>