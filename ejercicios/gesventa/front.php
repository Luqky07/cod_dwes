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
    require_once("productoDAO.inc.php");
    require_once("vista.inc.php");
    $v = new Vista("es");
    echo $v->cabecera();
    $prod = new ProductoDAO();
    ?>
</body>

</html>