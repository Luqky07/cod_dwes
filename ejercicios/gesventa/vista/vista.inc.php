<?php
require_once("const.inc.php");
require_once("modelo/productoDAO.inc.php");
class Vista {
    public $lang;
    public function __construct($lang = "en") {
        $this->lang = $lang;
    }

    function menu_nav() {
        $s = "";
        foreach (OPS as $k => $v) {
            $s .= "<a href='$v' style='margin: 0% 3%;'>";
            $s .= LANGS[$this->lang][$k] . "</a>\n";
        }
        return $s;
    }

    function tabla($t) {
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
    function tablaCR($t) {
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

    public function hola($ses) {
        $m =  "<h1>" . LANGS[$this->lang]['welcome'] . ", " . $ses['user'] . "</h1>";

        
        return $m . $this->formIdiom();
    }

    public function formIdiom() {
        $f = "<form action = '" . $_SERVER['PHP_SELF'] . "' method='POST'>";
        $f .= "<select name='lang'>\n";
        foreach (LANGS as $k => $v) {
            $f .= "<option value='$k' ";
            if ($this->lang == $k) $f .= "selected";
            $f .= ">" . $v["lang"] . "</option>";
        }
        $f .= "</select>\n";
        $f .= "<input name='idiom' type='submit' value='".LANGS[$this->lang]["idiom"]."'/>\n";
        $f .= "</form>";
        return $f;
    }

    public function cabecera() {
        $s = "<div style='width:100%; height: 20%; text-align:center; margin:1%'>\n";
        $s .= "<h1>GESVENTAS</h1>\n";

        $s .= $this->menu_nav() . BR;
        $s .= $this->hola($_SESSION);

        $s .= "</div>\n";
        return $s;
    }

    public function allProds() {
        $dao = new ProductoDAO();
        $prods = $dao->getAll();
        $list = "<table style='border: none; width:100%;'>\n<tbody>";
        foreach ($prods as $v) {
            $list .= "<tr style='padding: 0 20% 0 0;>\n
            <form action='http://localhost/gesventa/panel.php' method='POST'></form>\n";
            foreach ($v as $subK => $subV) {
                if (is_numeric($subK)) {
                    $list .= "<td style='left:10px;'>$subV</td>\n";
                }
            }
            $list .= "<td>\n<select name='uds'>\n<option value='0' selected=''>0</option>\n";
            if ($v[0] == 11 || $v[0] == 13 || $v[0] == 23 || $v[0] == 31 || $v[0] == 33) {
                for ($i = 1; $i <= 5; $i++) {
                    $list .= "<option value='$i'>$i</option>\n";
                }
            }
            $list .= "</select>\n</td>\n
                    <td><br><input type='submit' name='" . $v[0] . "' value='AÑADIR'></td>\n
                    <input type='hidden' name='prod' value='" . $v[0] . "'>\n";
        }
        echo $list;
    }
    public function formLogin() {
        $f = "<h1>".LANGS[$this->lang]["initMssg"]."</h1>\n";
        $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
        $f .= "<label for='user'>".LANGS[$this->lang]["user"]."</label>\n";
        $f .= "<input id='user' type='text' name='user'>".BR;
        $f .= "<label for='pass'>".LANGS[$this->lang]["pass"]."</label>\n";
        $f .= "<input id='pass' type='password' name='pass'>".BR;
        $f .= "<input type='submit' value='Login' name='enviar'>\n</form>\n";
        echo $f . BR . $this->formIdiom();
    }
}
