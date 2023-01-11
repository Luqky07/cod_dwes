<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once("model.inc.php");
    require_once("vista.inc.php");
    require_once("const.inc.php");

    $m = new Modelo();
    $v = new Vista();

    if (isset($_SESSION['user'])) {
        //Si vuelvo desde una página con sesión, la elimino
        $_SESSION = array();
        session_destroy();
    }

    if (isset($_POST['enviar'])) { //Se ha pulsado el botón alguna vez
        $error = $m->validar($_POST);
        //Si hay datos, $mensaje="" y pasamos a poner las variables de sesión
        if ($error == "") {
            $_SESSION['user'] = $_POST['USER'];
            //$_SESSION['lang'] = $_POST['lang']
            header('Location: front.php');
        } else {
            echo LANGS[$v->lang]['nodata'.BR];
        }
    }
    ?>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="user">Usuario</label>
        <input id="user" type="text" name="user">
        <br />
        <label for="pass">Contraseña</label>
        <input id="pass" type="password" name="pass">
        <br />
        <label for="lang">Idioma</label>
        <select id="lang" name="lang">
            <option value="esp">Español</option>
            <option value="eng">English</option>
            <option value="frc">Français</option>
        </select>
        <br />
        <input type="submit" value="Login">
    </form>
</body>

</html>