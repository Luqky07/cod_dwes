<!DOCTYPE html>
<html>
    <head>
        <title>Hola mundo</title>
    </head>
    <body>
        <!--<h3>Hola mundo en html</h3>-->
        <?php
            //echo "<h3>Hola mundo desde un echo</h3>\n";
            //$mivar = "\t\t<h3>Hola mundo desde una variable</h3>\n";
            //echo $mivar;
            //var_dump($_REQUEST);
            //echo "<br/> Contraseña: ",$_POST['psw'],"<br/>";
            foreach ($_REQUEST as $c => $v){
                echo "<br/>",$c," : ",$v,"<br/>";
            }
        ?>
    </body>
</html>