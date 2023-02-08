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

    if (isset($_POST["newProd"])) {
        echo $p -> insert($_POST);
    }

    $allFields = $p->allFields("productos");

    if (isset($_POST['search'])) {
        $prods = $p->getFilter($_POST);
    } else if (isset($_POST['noFilter'])) {
        $prods = $p->getAll();
    } else $prods = $p->getAll();

    if(isset($_POST["retrieve"]) || isset($_POST["search"])) $retrieve = true;
    else $retrieve = false;

    $_SESSION["lang"] = $v->getLang();

    echo $v->cabecera();

    $provs = $p -> getAllProvs();
    var_dump($provs);

    if (isset($_POST['new'])) echo $v->frontArticle($_POST, $allFields, $retrieve, $provs);
    else echo $v->frontArticle($prods, $allFields, $retrieve, $provs);
    ?>
</body>

</html>