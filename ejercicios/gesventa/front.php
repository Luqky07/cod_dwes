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
    <title>Productos</title>
</head>

<body>
    <?php
    require_once("modelo/productoDAO.inc.php");
    require_once("vista/vista.inc.php");
    $v;

    if (isset($_POST['idiom'])) $v = new Vista($_POST["lang"]);
    else {
        $v = new Vista($_SESSION["lang"]);
    }
    $_SESSION["lang"] = $v->lang;
    echo $v->cabecera();
    $prod = new ProductoDAO();
    ?>

    <div style="overflow:hidden; width:100%; height:80%;">
        <div id="tables" style="float:left; width:30%; ">
            <form action="http://localhost/gesventa/index.php" method="POST">
            </form>
            <fieldset style="border: 3px solid black; height: 150px">
                <legend>Gestionar: </legend>
            </fieldset>

            <fieldset style="border: 3px solid black; height: 150px">
                <legend>Filtros: </legend>
            </fieldset>
        </div>

        <div id="cuerpo" style="width:70%; float:left;">
            <fieldset style="border: 3px solid black; height: 320px">
                <legend>Resultados: </legend>
                <?php $v->allProds() ?>
            </fieldset>

        </div>

    </div>
</body>

</html>