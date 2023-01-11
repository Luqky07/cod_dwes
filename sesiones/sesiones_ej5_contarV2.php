<!--Esta linea valida el documento HTML, pero no forma parte del código HTML-->
<!DOCTYPE html>
<!--Esto debe ir antes de cualquier código HTML-->
<?php
session_start();
if (!empty($_POST["reiniciar"])) {
    $_SESSION = [];
    /* session_destroy();
    session_start(); */
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contar sesiones Ej 5</title>
</head>

<body>
    <h1>Sesiones: ejercicio 5</h1>
    <?php
    define("BR", "<br/>\n");

    $act_v = date("d/m/Y h:i:s");

    echo "Sesion iniciada con id: " . session_id() . BR;
    echo "Visita actual = $act_v" . BR;

    $visitas = (isset($_SESSION['cont']) ? $_SESSION['cont'] : 0);
    mostrarVisitas($visitas);
    
    $_SESSION['ult_visita'] = $act_v;
    function mostrarVisitas($cont)
    {
        if($cont < 1) {
            $_SESSION["cont"] = 1;
            echo "1 visita" . BR . "Nuevo en el lugar" . BR;
        } else {
            $_SESSION['cont']++;
            echo $_SESSION['cont'] . " visistas" . BR;
            echo "Ultima visita = " . $_SESSION['ult_visita'] . BR;
        }
    }
    ?>
    <form method='POST' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        <input type="submit" name="reiniciar" value="Reiniciar contador">
    </form>
    <form method='POST' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        <input type="submit" name="continuar" value="Continuar contador">
    </form>

</body>

</html>