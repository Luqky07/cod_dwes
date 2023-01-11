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

        $m = new Modelo();
        $v = new Vista();

        if(isset($_SESSION['user'])){
            //Si vuelvo desde una página con sesión, la elimino
            $_SESSION = array();
            session_destroy();
        }

        if(isset($_POST['enviar'])){//Se ha pulsado el botón alguna vez
            $error=$m->validar($_POST);
            //Si hay datos, $mensaje="" y pasamos a poner las variables de sesión
            if($error==""){
                $_SESSION['user']=$_POST['USER'];
                //$_SESSION['lang'] = $_POST['lang']
            }
        }
    ?>
</head>
<body>
    
</body>
</html>