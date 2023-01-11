
<!DOCTYPE html>
<?php
include_once("../modelos/gesventa.inc.php");
include_once("../modelos/vista.inc.php");
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>
<body>
    <h3>Ejercicio 2</h3>
    <?php
    $v=new Vista();

    try{
        $cadenaDSN="mysql:host=".HOST.";dbname=".BD.";charset=".CHRST;
        $con = new PDO(CONN,USER,PWD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt=$con->query("SELECT * FROM proveedores");

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ee=$stmt->fetchAll();
        $con=null;
        $v->tablaCR($ee);
    }catch(PDOException $e){
        print("Error ".$e->getMessage()."<br/>");
        exit;
    }
        
    ?>
</body>
</html>