<?php
require_once("const.inc.php");
require_once("../modelo/productoDAO.inc.php");
class Vista
{
    private $lang;
    public function __construct()
    {
        $this->lang = array_keys(LANGS)[0];
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setLang($lang)
    {
        $this->lang = $lang;
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

    private function menu_nav()
    {
        $s = "";
        foreach (OPS as $k => $v) {
            $s .= "<a href='$v' style='margin: 0% 3%;'>";
            $s .= LANGS[$this->lang][$k] . "</a>\n";
        }
        return $s;
    }

    private function hola($ses)
    {
        $m =  "<h1>" . LANGS[$this->lang]['welcome'] . ", " . $ses['user'] . "</h1>\n";


        return $m;
    }

    private function formIdiom()
    {
        $f = "<form action = '" . $_SERVER['PHP_SELF'] . "' method='POST'>\n";
        $f .= "<select name='lang'>\n";
        foreach (LANGS as $k => $v) {
            $f .= "<option value='$k' ";
            if ($this->lang == $k) $f .= "selected";
            $f .= ">" . $v["lang"] . "</option>\n";
        }
        $f .= "</select>\n";
        $f .= "<input name='idiom' type='submit' value='" . LANGS[$this->lang]["idiom"] . "'/>\n";
        $f .= "</form>\n";
        return $f;
    }

    public function cabecera()
    {
        $s = "<div style='width:100%; height: 20%; text-align:center; margin:1%'>\n";
        $s .= "<h1>" . TTL . "</h1>\n";

        $s .= $this->menu_nav() . BR;
        $s .= $this->hola($_SESSION);
        $s .= $this->formIdiom();

        $s .= "</div>\n";
        return $s;
    }

    /*
    A mejorar:
        -Cambiar la función para que trabaje recibiendo un array y no usando métodos del
        Modelo.
    */
    private function allProds($prods, $allFields)
    {
        if (empty($prods)) return "<h1 style='text-align:center;'>" . LANGS[$this->lang]["noProd"] . "</h1>\n";
        else {
            $list = "<table style='border: none; width:100%;'>\n<thead>\n";
            $list .= "<tr style='padding: 0 20% 0 0;'>\n";
            foreach ($allFields as $k => $v) {
                $list .= "<th>" . LANGS[$this->lang][$k] . "</th>\n";
            }
            $list .= "</tr>\n</thead>\n<tbody>\n";
            foreach ($prods as $p) {
                $list .= "<tr style='padding: 0 20% 0 0;'>\n";
                foreach ($p as $k => $v) {
                    if ($k == "imagen") $list .= "<td style='left:10px; padding-left: 30px;'><img src='../img/$v'></td>\n";
                    else $list .= "<td style='left:10px; padding-left: 30px;'>$v</td>\n";
                }
            }
            $list .= "</tr>\n</tbody>\n</table>\n";
            return $list;
        }
    }

    public function formLogin()
    {
        $l = LANGS[$this->lang];
        $f = "<h1>" . $l["initMssg"] . "</h1>\n";
        $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
        $f .= "<label for='user'>" . $l["user"] . "</label>\n";
        $f .= "<input id='user' type='text' name='user'>" . BR;
        $f .= "<label for='pass'>" . $l["pass"] . "</label>\n";
        $f .= "<input id='pass' type='password' name='pass'>" . BR;
        $f .= "<input type='submit' value='Login' name='enviar'>\n</form>\n";
        echo $f . BR . $this->formIdiom();
    }

    public function frontMenu()
    {
        $roll = $_SESSION['roll'];
        $f = "<fieldset style='border: 2px solid black; height: 50%'>\n";
        $f .= "<legend>" . LANGS[$this->lang]["menu"] . ": </legend>\n";
        foreach (CRUD[$roll] as $v) {
            $f .= "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>\n";
            $f .= "<input type='submit' name='$v' value='" . LANGS[$this->lang][$v] . "'>" . BR;
            $f .= "</form>\n";
        }
        $f .= "</fieldset>\n";
        $f .= "<fieldset style='border: 2px solid black; height: 50%'>\n";
        return $f;
    }

    public function frontFiltro($allFields, $retrieve)
    {
        $f = "<legend>" . LANGS[$this->lang]["filters"] . ": </legend>\n";
        if ($retrieve) {
            if (isset($_POST["search"])) {
                $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
                foreach ($allFields as $k => $v) {
                    if ($k != "imagen") {
                        $f .= "<label for='filter_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                        if ($v == "varchar") $f .= "<input type='text' name = 'filter_$k' value = '". $_POST["filter_".$k] ."'>" . BR;
                        else if ($v == "int") $f .= "<input type='number' name = 'filter_$k' value = '". $_POST["filter_".$k] ."'>" . BR;
                        else if ($v == "decimal") $f .= "<input type='number' step='0.01' name = 'filter_$k' value = '". $_POST["filter_".$k] ."'>" . BR;
                    }
                }
                $f .= "<input type='submit' name='search' value= '" . LANGS[$this->lang]["search"] . "'>\n";
                $f .= "</form>\n";
                $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
                $f .= "<input type='submit' name='noFilter' value= '" . LANGS[$this->lang]["noFilter"] . "'>\n";
                $f .= "</form>\n";
            } else {
                $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
                foreach ($allFields as $k => $v) {
                    if ($k != "imagen") {
                        $f .= "<label for='filter_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                        if ($v == "varchar") $f .= "<input type='text' name = 'filter_$k'>" . BR;
                        else if ($v == "int") $f .= "<input type='number' name = 'filter_$k'>" . BR;
                        else if ($v == "decimal") $f .= "<input type='number' step='0.01' name = 'filter_$k'>" . BR;
                    }
                }
                $f .= "<input type='submit' name='search' value= '" . LANGS[$this->lang]["search"] . "'>\n";
                $f .= "</form>\n";
            }
        } else $f .= "<h3>" . LANGS[$this->lang]["filtreMssg"] . "</h3>\n";
        $f .= "</fieldset>\n";
        return $f;
    }

    public function frontCuerpo($prods, $allFields)
    {
        $f = "<div id='cuerpo' style='width:70%; float:left; height: 95%;'>\n";
        $f .= "<fieldset style='border: 2px solid black; height: 100%; overflow:scroll;'>\n";
        $f .= "<legend>" . LANGS[$this->lang]["section"] . ": </legend>\n";
        $f .= $this->allProds($prods, $allFields);
        $f .= "</fieldset>\n</div>\n";
        return $f;
    }

    public function frontArticle($arr, $allFields, $retrieve)
    {
        $f = "<div style='overflow:hidden; width:100%; height: 380px'>\n";
        $f .= "<div id='tables' style='float:left; width:30%; height: 89.7%'>\n";
        $f .= $this->frontMenu();
        $f .= $this->frontFiltro($allFields, $retrieve);
        $f .= "</div>\n";
        if (isset($arr['new'])) $f .= $this->frontNewProd($allFields);
        else $f .= $this->frontCuerpo($arr, $allFields);
        $f .= "</div>\n";
        return $f;
    }

    public function frontNewProd($allFields)
    {
        $f = "<fieldset style='border: 2px solid black; height: 95%; overflow:scroll;'>\n";
        $f .= "<legend>" . LANGS[$this->lang]["newProd"] . ": </legend>\n";
        $f .= "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>\n";
        foreach ($allFields as $k => $v) {
            if ($v != "imagen") {
                $f .= "<label for='new_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                $f .= "<input type='text' name='new_$k'>" . BR;
            }
        }
        $f .= "<input type='submit' name='newProd' value='" . LANGS[$this->lang]["btnNewProd"] . "'>\n";
        $f .= "</form>\n</fieldset>\n";
        return $f;
    }

    public function mostrarBoton($post)
    {
        $f = "";
        foreach ($post as $k => $v) {
            foreach (CRUD as $roll) {
                foreach ($roll as $c) {
                    if ($k == $c) {
                        if (isset($post[$k])) $f = "<h3>Se ha pulsado el botón $v</h3>";
                    }
                }
            }
        }
        echo $f;
    }
}
