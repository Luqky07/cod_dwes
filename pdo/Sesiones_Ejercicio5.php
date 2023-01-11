<!DOCTYPE html>
<?php
//ses_5_contar.php
//esto debe ir antes de cualquier código html
    session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Sesiones: Ejercicio 5</h1>
        <?php
            print("Sesion iniciada con id= ".session_id()."\n<br/>");
            if(!isset($_SESSION['cont'])){
                $_SESSION['cont']=1;
                print("1ª visita: Nuevo en el lugar\n <br/>");
        
            }else{
                echo $_SESSION['cont']." visitas\n<br/>";
                ++$_SESSION['cont'];
            }
        ?>
    </body>
</html>