<!DOCTYPE html>
<?php
session_start();

require_once("modelo/model.inc.php");
require_once("vista/vista.inc.php");
require_once("vista/const.inc.php");

$m = new Modelo();
$v;

if (isset($_SESSION['user'])) {
    //Si vuelvo desde una página con sesión, la elimino
    $_SESSION = array();
    session_destroy();
}

if (isset($_POST['idiom'])) $v = new Vista($_POST["lang"]);
else {
    if (isset($_SESSION["lang"])) $v = new Vista($_SESSION["lang"]);
    else $v = new Vista("es");
}
$_SESSION["lang"] = $v->lang;

if (isset($_POST['enviar'])) { //Se ha pulsado el botón alguna vez
    $error = $m->validar($_POST);
    //Si hay datos, $mensaje="" y pasamos a poner las variables de sesión
    if ($error == "") {
        $_SESSION['user'] = $_POST['user'];
        //$_SESSION['lang'] = $_POST['lang']
        header('Location: front.php');
    } else echo LANGS[$v->lang][$error] . BR;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login gesventa</title>
</head>

<body>

    <?php
    $v->formLogin();
    ?>

</body>

</html>