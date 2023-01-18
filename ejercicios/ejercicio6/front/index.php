<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['user'])){
        header("Location: ../index.php");
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion <?php echo $_SESSION['user'] ?></title>
    <?php
    require_once("../conn.inc.php");
    ?>
</head>

<body>

</body>

</html>