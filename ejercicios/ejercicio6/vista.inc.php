<?php
require_once("const.inc.php");
class Vista
{
    public $lang;
    public function __construct($lang = "en")
    {
        $this->$lang = $lang;
    }

    function tabla($t)
    {
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
    function tablaCR($t)
    {
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

    public function hola($ses)
    {
        echo "<h1>" . LANGS[$this->lang]['welcome'] . "," . $ses['user'] . "</h1>";
    }

    public function cabecera($opt)
    {
        $s = "<div style='width:100%; height: 20%; text-align:center; margin:1%'>";
        $s .= "<h1>GESVENTAS</h1>\n";
        foreach(OPS['es'] as $k => $v){
            $s.= "<a href='$v' style='margin: 0% 3%;'>";
            $s.= LANGS[$this->lang][$k]."</a>\n";
        }

        $this->hola($_SESSION);
        $s.="</div";
    }
}
