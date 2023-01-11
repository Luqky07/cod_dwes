<?php
define("BR", "<br/>\n");
class Vista{
    public function Vista(){}

    function tabla($t){
        //var_dump($t);
        echo ("<table border=1>" . BR);
        //$s.="<tr><th>Cod.</th><tr><th>Nombre</th><tr><th>Clave</th><tr><th>Rol</th></tr>";
        echo ("<tr>");
        foreach ($t[0] as $k => $f) {
            echo ("<th>$k</th>");
        }
        echo ("</tr>");
        foreach ($t as $k => $f) {
            echo ("<tr>");
            foreach ($f as $v) {
                echo ("<td>$v</td>\n");
            }
            echo ("</tr>\n");

        }
        echo ("</table>\n");

    }
    function tablaCR($t){
        $s = "<table border=1>" . BR;
        //$s.="<tr><th>Cod.</th><tr><th>Nombre</th><tr><th>Clave</th><tr><th>Rol</th></tr>";
        $s .= "<tr>";
        foreach ($t[0] as $k => $f) {
            $s .= "<th>$k</th>";
        }
        $s .= "</tr>";
        foreach ($t as $k => $f) {
            $s .= "<tr>";
            foreach ($f as $v) {
                $s .= "<td>$v</td>\n";
            }
            $s .= "</tr>\n";

        }
        $s . "</table>\n";
        echo $s;
    }
}