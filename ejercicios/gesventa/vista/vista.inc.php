<?php
//Importación de archivos necesarios
require_once("const.inc.php");
require_once("../modelo/productoDAO.inc.php");

//Clase para gestionar todas la funciones que permiten dar estilo a datos en la página
class Vista
{
    //Atributo que representa el idioma de la clase Vista
    private $lang;

    //Constructor de la clase vista
    public function __construct()
    {
        $this->lang = array_keys(LANGS)[0];
    }

    //Devuelve el idioma del objeto Vista 
    public function getLang()
    {
        return $this->lang;
    }

    //Permite cambiar el idioma del objeto Vista
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /*
    Crea una conjunto de enlaces en función de los valores que contiene la constante OPS
    del fichero const.inc.php y se modifica el texto que se muestra en función del idioma
    */
    private function menu_nav()
    {
        $s = "";
        foreach (OPS as $k => $v) {
            $s .= "<a href='$v' style='margin: 0% 3%;'>";
            $s .= LANGS[$this->lang][$k] . "</a>\n";
        }
        return $s;
    }

    /*
    Genera una cabecera con un mensaje de bienvenida en función del idioma de la clase
    y del nombre del usuario
    */
    private function header_welcome($usr)
    {
        $m =  "<h1>" . LANGS[$this->lang]['welcome'] . ", " . $usr . "</h1>\n";
        return $m;
    }

    /*
    Genera un formulario para poder establecer el idioma de la página, establecerán tantos
    idiomas como tengamos almacenados en la constante LANGS del fichero const.inc.php
    también se seleccionará por defecto en el <select> el idioma del objeto Vista
    */
    private function formIdiom($route)
    {
        $f = "<form action = '" . $route . "' method='POST'>\n";
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

    //Permite generar
    public function cabecera($usr, $route)
    {
        $s = "<div style='width:100%; height: 20%; text-align:center; margin:1%'>\n";
        $s .= "<h1>" . TTL . "</h1>\n";

        $s .= $this->menu_nav() . BR;
        $s .= $this->header_welcome($usr);
        $s .= $this->formIdiom($route);

        $s .= "</div>\n";
        return $s;
    }

    /*
    A mejorar:
        -Cambiar la función para que trabaje recibiendo un array y no usando métodos del
        Modelo.
    */
    public function allProds($prods, $allFields)
    {
        if (empty($prods)) return "<h1 style='text-align:center;'>" . LANGS[$this->lang]["noProd"] . "</h1>\n";
        else {
            $list = "<table style='border: none; width:100%;'>\n<thead>\n";
            $list .= "<tr style='padding: 0 20% 0 0;'>\n";
            foreach ($allFields as $k) {
                $list .= "<th>" . LANGS[$this->lang][$k] . "</th>\n";
            }
            $list .= "</tr>\n</thead>\n<tbody>\n";
            foreach ($prods as $p) {
                $list .= "<tr style='padding: 0 20% 0 0;'>\n";
                foreach ($p as $k => $v) {
                    if ($k == "imagen") $list .= "<td style='left:10px; padding-left: 30px;'><img src='../img/$v'></td>\n";
                    else if ($k == "existencias") $list .= $this->frontFormBuy($p);
                    else $list .= "<td style='left:10px; padding-left: 30px;'>$v</td>\n";
                }
            }
            $list .= "</tr>\n</tbody>\n</table>\n";
            return $list;
        }
    }

    public function frontFormBuy($p)
    {
        $form = "<td style='left:10px; padding-left: 30px;'>\n";
        if ($p["existencias"] == 0) {
            $form .= "<strong>" . LANGS[$this->lang]["notAvailable"] . "</strong>\n";
        } else if ($p["existencias"] > 5) {
            $form .= "<form method = 'POST' action = '" . $_SERVER['PHP_SELF'] . "'>\n";
            $form .= "<select name='num_prods'>\n";
            for ($i = 1; $i <= 5; $i++) {
                $form .= "<option value = '" . $p["cod"] . "_$i" . "'>$i</option>\n";
            }
            $form .= "</select>\n";
            $form .= "<input type='submit' name='addProduct' value='" . LANGS[$this->lang]["add"] . "'>\n";
            $form .= "</form>\n";
        } else {
            $form .= "<form method = 'POST' action = '" . $_SERVER['PHP_SELF'] . "'>\n";
            $form .= "<select name='num_prods'>\n";
            for ($i = 1; $i <= $p["existencias"]; $i++) {
                $form .= "<option value = '" . $p["cod"] . "_$i" . "'>$i</option>\n";
            }
            $form .= "</select>\n";
            $form .= "<input type='submit' name='addProduct' value='" . LANGS[$this->lang]["add"] . "'>\n";
            $form .= "</form>\n";
        }
        $form .= "</td>\n";
        return $form;
    }

    public function formLogin($route)
    {
        $l = LANGS[$this->lang];
        $f = "<h1>" . $l["initMssg"] . "</h1>\n";
        $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
        $f .= "<label for='user'>" . $l["user"] . "</label>\n";
        $f .= "<input id='user' type='text' name='user'>" . BR;
        $f .= "<label for='pass'>" . $l["pass"] . "</label>\n";
        $f .= "<input id='pass' type='password' name='pass'>" . BR;
        $f .= "<input type='submit' value='Login' name='enviar'>\n</form>\n";
        echo $f . BR . $this->formIdiom($route);
    }

    public function frontMenu()
    {
        $rol = $_SESSION['rol'];
        $f = "<fieldset style='border: 2px solid black; height: 50%'>\n";
        $f .= "<legend>" . LANGS[$this->lang]["menu"] . ": </legend>\n";
        foreach (CRUD[$rol] as $v) {
            $f .= "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>\n";
            $f .= "<input type='submit' name='$v' value='" . LANGS[$this->lang][$v] . "'>" . BR;
            $f .= "</form>\n";
        }
        $f .= "</fieldset>\n";
        $f .= "<fieldset style='border: 2px solid black; height: 50%'>\n";
        return $f;
    }

    public function frontSeccion($allFields, $seccion, $provs)
    {
        if ($seccion == "filter") {
            $f = "<legend>" . LANGS[$this->lang]["filters"] . ": </legend>\n";
            $f .= "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>\n";
            foreach ($allFields as $k => $v) {
                if ($k != "imagen") {
                    $f .= "<label for='filter_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                    if ($v == "varchar") {
                        if (isset($_POST["filter_" . $k])) $f .= "<input type='text' name = 'filter_$k' value = '" . $_POST["filter_" . $k] . "'>" . BR;
                        else $f .= "<input type='text' name = 'filter_$k'>" . BR;
                    } else if ($v == "int") {
                        if (isset($_POST["filter_" . $k])) $f .= "<input type='number' name = 'filter_$k' value = '" . $_POST["filter_" . $k] . "'>" . BR;
                        else $f .= "<input type='number' name = 'filter_$k'>" . BR;
                    } else if ($v == "decimal") {
                        if (isset($_POST["filter_" . $k])) $f .= "<input type='number' step='0.01' name = 'filter_$k' value = '" . $_POST["filter_" . $k] . "'>" . BR;
                        else $f .= "<input type='number' step='0.01' name = 'filter_$k'>" . BR;
                    }
                }
            }
            $f .= "<input type='submit' name='search' value= '" . LANGS[$this->lang]["search"] . "'>\n";
            $f .= "</form>\n";
        } else if ($seccion == "new") {
            $f = "<legend>" . LANGS[$this->lang]["newProd"] . ": </legend>\n";
            $f .= $this->frontNewProd($allFields, $provs);
        } else {
            $f = "<legend>" . LANGS[$this->lang]["section"] . ": </legend>\n";
            $f .= "<h3>" . LANGS[$this->lang]["filtreMssg"] . "</h3>\n";
        }
        $f .= "</fieldset>\n";
        return $f;
    }

    public function frontCuerpo($prods, $allFields)
    {
        $f = "<div id='cuerpo' style='width:70%; float:left; height: 95%;'>\n";
        $f .= "<fieldset style='border: 2px solid black; height: 100%; overflow:scroll;'>\n";
        $f .= "<legend>" . LANGS[$this->lang]["prods"] . ": </legend>\n";
        $f .= $this->allProds($prods, array_keys($allFields));
        $f .= "</fieldset>\n</div>\n";
        return $f;
    }

    public function frontArticle($prods, $allFields, $seccion, $provs)
    {
        $f = "<div style='overflow:hidden; width:100%; height: 380px'>\n";
        $f .= "<div id='tables' style='float:left; width:30%; height: 89.7%'>\n";
        $f .= $this->frontMenu();
        $f .= $this->frontSeccion($allFields, $seccion, $provs);
        $f .= "</div>\n";
        $f .= $this->frontCuerpo($prods, $allFields);
        $f .= "</div>\n";
        return $f;
    }

    public function frontNewProd($allFields, $provs)
    {
        $f = "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>\n";
        foreach ($allFields as $k => $v) {
            if ($k == "prov") {
                $f .= "<label for='new_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                $f .= "<select name='new_$k'>\n";
                foreach ($provs as $prov) {
                    $f .= "<option value='" . $prov["cif"] . "'>" . $prov["cif"] . "</option>\n";
                }
                $f .= "</select>" . BR;
            } else {
                if ($k != "imagen" && $k != "cod") {
                    $f .= "<label for='new_$k'>" . LANGS[$this->lang][$k] . "</label>\n";
                    if ($v == "varchar") {
                        $f .= "<input type='text' name = 'new_$k' required>" . BR;
                    } else if ($v == "int") {
                        $f .= "<input type='number' name = 'new_$k'>" . BR;
                    } else if ($v == "decimal") {
                        $f .= "<input type='number' step='0.01' name = 'new_$k'>" . BR;
                    }
                }
            }
        }
        $f .= "<input type='submit' name='newProd' value='" . LANGS[$this->lang]["btnNewProd"] . "'>\n";
        $f .= "</form>\n";
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
