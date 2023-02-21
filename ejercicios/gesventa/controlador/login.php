<!DOCTYPE html>
<?php
//Antes de cualquier código HTML o PHP abrimos la sesión
session_start();

//Importamos todos los archivos que necesitemos
require_once("../modelo/model.inc.php");
require_once("../vista/vista.inc.php");
require_once("../vista/const.inc.php");

//Creamos los objetos Modelo y Vista
$m = new Modelo();
$v = new Vista();

/*
Si se ha pulsado el botón para cambiar el idioma, también se cambiará el idioma el objeto
vista, en caso contrario si ya hay un idioma almacenado en la sesión también cambiaremos
el idioma del objeto Vista
*/
if (isset($_POST['idiom'])) $v->setLang($_POST["lang"]);
else if (isset($_SESSION["lang"])) $v->setLang($_SESSION["lang"]);

/*
Si ya se había iniciado una sesión correctamente anteriormente y se llega de vuelta a
esta página se borrarán todos los datos de esa sesión 
*/
if (isset($_SESSION['user'])) {
    $_SESSION = [];
    session_destroy();
}

//Se almacena en la sesión el idioma que se está utilizando
$_SESSION["lang"] = $v->getLang();

/*
En caso de que se pulse el botón para iniciar sesión se validarán los datos mediante el
objeto Modelo, si no devuelve un mensaje de error, en la sesión almacenaremos el nombre
del usuario (tendrá un patrón de nombre propio, primera letra en mayúscula y resto en
minúscula), además recogeremos la información del rol que tendrá de la base de datos y la
guardaremos en la sesión, por último redirigiremos la página a front.php.
El caso de que se devuelva un mensaje de error se mostrará por pantalla.
*/
if (isset($_POST['enviar'])) {
    $error = $m->validar($_POST);
    if ($error == "") {
        $_SESSION['user'] = ucfirst(strtolower($_POST['user']));
        $_SESSION['rol'] = $m->getUsrRoll($_POST['user']);
        header('Location: front.php');
    } else echo LANGS[$v->getLang()][$error] . BR;
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
    /*
    Mostramos el formulario de login mediante una función del objeto Vista enviando como
    parámetro la dirección de la página
    */
    $v->formLogin($_SERVER['PHP_SELF']);
    ?>

</body>

</html>