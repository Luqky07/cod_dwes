<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>\n");
    /*
    echo "Ruta desde htdocs: ".$_SERVER['PHP_SELF'].BR;
    echo "Nombre del server: ".$_SERVER["SERVER_NAME"].BR;
    echo "Software del server: ".$_SERVER["SERVER_SOFTWARE"].BR;
    echo "Protocolo: ".$_SERVER["SERVER_PROTOCOL"].BR;
    echo "Método de la petición: ".$_SERVER["REQUEST_METHOD"].BR;
    */
    foreach($_SERVER as $k=>$v){
        echo "valor de \$_SERVER[$k]: $v".BR;
    }
    ?>
</body>

</html>