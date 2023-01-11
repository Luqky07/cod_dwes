<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>\n");
    $a = "Hola";
    $s1 = "Digo: $a" . BR;
    $s2 = 'Digo: $a' . BR;
    echo $s1 . $s2;
    ?>
</body>

</html>