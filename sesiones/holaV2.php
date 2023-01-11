<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $lang = (empty($_SESSION['lang']) ? "es" : $_SESSION['lang']);
    $colores = ["b" => "blue", "r" => "red", "y" => "yellow"];
    $mssgs = [
        "es" => ["entrar" => "Bienvenido", "salir" => "Hasta pronto", "error" => "NO puedes entrar en la página"],
        "en" => ["entrar" => "Welcome", "salir" => "Goodbye", "error" => "You can not access to this page"],
        "fr" => ["entrar" => "Bienvenu", "salir" => "Au revoir", "error" => "Prohibida la entrada a franceses"]
    ];
    $color = (empty($_SESSION['color']) ? "orange" : $colores[$_SESSION['color']]);
    bgcolor($color);

    //recibimos diferentes valores de personalización
    //y personalizamos la página

    if (!isset($_SESSION['user'])) {
        //si no existen las variables de sesión
        mostrarError($lang, $mssgs);
        //echo "NO puedes entrar en la página<br/>";
    } else {
        bienvenida($_SESSION['lang'], $_SESSION['user'], $mssgs);
    }


    salida($lang, "ses_6_login.php", $mssgs);

    function bgcolor($c)
    {
        $res = "<body bgcolor='" . $c . "'>\n";
        echo $res;
    }

    function bienvenida($lang, $usr, $mssgs)
    {
        $res = "<h2>" . $mssgs[$lang]['entrar'] . ", " . $usr . "</h2>\n";
        echo $res;
    }
    function salida($lang, $href, $mssgs)
    {
        $res = "<a href='$href'>" . $mssgs[$lang]['salir'] . "</a>\n";
        echo $res;
    }
    function mostrarError($lang, $mssgs)
    {
        $res = "<h1>" . $mssgs[$lang]['error'] . "</h1>\n";
        echo $res;
    }
    ?>
</body>

</html>