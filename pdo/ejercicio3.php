
<!DOCTYPE html>
<?php
require_once("../modelos/conn.php");
require_once("../modelos/vista.inc.php");
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3</title>
</head>
<body>
    <h3>Ejercicio 3</h3>
    <?php
    $v=new Vista();

    try{
        // $con = new PDO(CONN,USER,PWD);
        // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con=new Conn();
        $bd=$con->getConn();

        // $stmt=$con->query("UPDATE proveedores SET poblacion='Trescantos' WHERE cif='D7767763A'");
        // $stmt=$con->query("SELECT * FROM proveedores");

        // $stmt=$con->prepare("UPDATE proveedores SET poblacion=:pob WHERE nom_emp=:emp");
        
        $stmt=$bd->prepare("UPDATE proveedores SET poblacion=:pob WHERE nom_emp=:emp");
        
        // $stmt=$con->prepare("UPDATE proveedores SET poblacion=? WHERE nom_emp=?");
        /*$stmt->bindValue(1, "Getafe");//admin
        $stmt->bindValue(2, "Ozone");//admin*/

       
        $stmt->execute([':pob'=>"Madrid",':emp'=>"Ozone"]);
        /*
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ee=$stmt->fetchAll();*/

        $n=$stmt->rowCount();
        // var_dump($ee);
        echo("Filas afectadas: ".$n);

        $con->close();
    }catch(PDOException $e){
        print("Error ".$e->getMessage()."<br/>");
        exit;
    }
    ?>
</body>
</html>