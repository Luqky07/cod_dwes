<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once("modelo/model.inc.php");
    require_once("vista/vista.inc.php");
    require_once("vista/const.inc.php");

    $m = new Modelo();
    $v = new Vista("es");

    if (isset($_SESSION['user'])) {
        //Si vuelvo desde una página con sesión, la elimino
        $_SESSION = array();
        session_destroy();
    }

    if (isset($_POST['enviar'])) { //Se ha pulsado el botón alguna vez
        $error = $m->validar($_POST);
        //Si hay datos, $mensaje="" y pasamos a poner las variables de sesión
        if ($error == "") {
            $_SESSION['user'] = $_POST['user'];
            //$_SESSION['lang'] = $_POST['lang']
            header('Location: front.php');
        } else {
            echo "ERROR en el usuario o contraseña" . BR;
        }
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="user">Usuario</label>
        <input id="user" type="text" name="user">
        <br />
        <label for="pass">Contraseña</label>
        <input id="pass" type="password" name="pass">
        <br />
        <input type="submit" value="Login" name="enviar">
    </form>
</body>

</html>