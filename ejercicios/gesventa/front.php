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
    require_once("vista/vista.inc.php");
    $v = new Vista();

    if (isset($_POST['idiom'])) $v->setLang($_POST["lang"]);
    else if (isset($_SESSION["lang"])) $v->setLang($_SESSION["lang"]);

    $_SESSION["lang"] = $v->getLang();

    echo $v->cabecera();
    echo $v->frontArticle();

    ?>
</body>

</html>