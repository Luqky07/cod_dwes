<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: login.php")
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de <?php echo $_SESSION["user"] ?></title>
</head>
<body>
    <?php
    require_once("../vista/vista.inc.php");
    require_once("../modelo/productoDAO.inc.php");
    require_once("../modelo/model.inc.php");

    $v = new Vista();
    $p = new ProductoDAO();
    $m = new Modelo();

    if (isset($_POST['idiom'])) $v->setLang($_POST["lang"]);
    else if (isset($_SESSION["lang"])) $v->setLang($_SESSION["lang"]);
    $_SESSION["lang"] = $v->getLang();

    echo $v->cabecera($_SESSION["user"], $_SERVER['PHP_SELF']);

    $cart = unserialize($_COOKIE[$_SESSION["user"] . "_cart"]);
    $prods = $p->gets(array_keys($cart));
    //var_dump($prods);
    $allFieldsProd = array_keys($m->allFields("productos"));
    var_dump($cart);
    echo $v -> carritoProds($prods, $cart, $allFieldsProd, $_SERVER['PHP_SELF']);
    ?>
</body>
</html>