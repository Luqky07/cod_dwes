<?php
require_once("const.inc.php");
class Vista
{
    public $lang;
    public function __construct($lang = "en")
    {
        $this->lang = $lang;
    }

    function menu_nav() {
        $s ="";
        foreach (OPS as $k => $v) {
            $s .= "<a href='$v' style='margin: 0% 3%;'>";
            $s .= LANGS[$this->lang][$k] . "</a>\n";
        }
        return $s;
    }

    function tabla($t)
    {
        echo ("<table border=1>" . BR);
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
        $m =  "<h1>" . LANGS[$this->lang]['welcome'] . ", " . $ses['user'] . "</h1>";

        $f = "<form action = '" . $_SERVER['PHP_SELF'] . "' method='POST'>";
        $f .= "<select name='lang'>\n";
        foreach (LANGS as $k => $v) {
            $f .= "<option value='$k'>" . $v["lang"] . "</option>";
        }
        $f .= "</select>\n";
        $f .= "<input name='enviar' type='submit' value='enviar'/>\n";
        $f .= "</form>";
        return $m . $f;
    }

    public function cabecera()
    {
        $s = "<div style='width:100%; height: 20%; text-align:center; margin:1%'>\n";
        $s .= "<h1>GESVENTAS</h1>\n";

        $s .= $this->menu_nav().BR;
        $s .= $this->hola($_SESSION);

        $s .= "</div>";
        return $s;
    }
}