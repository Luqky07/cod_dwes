<!DOCTYPE html>
<html>
    <?php
        $entero = 3.5;
        echo "$entero<br/>\n";
        $entero = "hola";
        echo "\t$entero<br/>\n";
        echo gettype($entero),"<br/>";
        $max = PHP_INT_MAX + 1;
        echo $max,"<br/>\n";
        echo gettype($max);
    ?>
</html>