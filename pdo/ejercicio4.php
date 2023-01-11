
<!DOCTYPE html>
<?php
require_once("../modelos/conn.php");
require_once("../modelos/vista.inc.php");
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
</head>
<body>
    <h3>Ejercicio 4</h3>
    <?php
    $v=new Vista();

    try{
        $con=new Conn();
        $bd=$con->getConn();
        
        $stmt=$bd->prepare("DELETE FROM proveedores WHERE poblacion=:pob");
        $stmt->execute([':pob'=>"Madrid"]);

        $n=$stmt->rowCount();
        echo("Filas afectadas: ".$stmt->rowCount());

        $con->close();
    }catch(PDOException $e){
        print("Error ".$e->getMessage()."<br/>");
        exit;
    }
    ?>
</body>
</html>