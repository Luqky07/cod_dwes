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
    <title>Productos <?php echo $_SESSION['user'] ?></title>
</head>

<body>
    <?php
    require_once("../vista/vista.inc.php");
    require_once("../modelo/productoDAO.inc.php");
    $v = new Vista();
    $p = new ProductoDAO();

    if (isset($_POST['idiom'])) $v->setLang($_POST["lang"]);
    else if (isset($_SESSION["lang"])) $v->setLang($_SESSION["lang"]);

    
    if(isset($_POST['search'])) {
        $res = $p->get($_POST["prodCod"]);
        if(!is_string($res)) $prods = $res;
        else $prods = $p->getAll();
    }
    else $prods = $p->getAll();

    $_SESSION["lang"] = $v->getLang();

    echo $v->cabecera();
    echo $v->frontArticle($prods);

    echo $v->mostrarBoton($_POST);
    ?>
</body>

</html>