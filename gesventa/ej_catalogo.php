<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTIÓN DE VENTASFORM-/gesventa/ej_catalogo.php</title>
</head>

<body>
    <br>
    <div style="width:100%; height:20%; text-align:center; margin:1%;">
        <h1>BIENVENIDO a GESVENTAS</h1>
        <?php
        define("BR", "<br/>\n"); //Constante importante
        $menu = array("LOGIN" => "login", "REGISTRARSE" => "registro", "LOGOUT" => "logout", "INICIO" => "index", "CARRITO" => "carrito");
        foreach ($menu as $k =>  $v) {
            echo "<a href='hhttp://localhost/gesventa/$v.php' style='margin: 0% 3%;'>$k</a>\n";
        }
        ?>
    </div>
    <div style="overflow:hidden; width:100%; height:80%;">
        <div id="tables" style="float:left; width:30%; ">
            <form action="http://localhost/gesventa/index.php" method="POST">
                <!--target="_blank"-->
            </form>
            <fieldset>
                <legend>Gestionar: </legend>
                <table>
                    <tbody>
                        <?php
                        $gestion = array("clientes", "facturas", "productos", "proveedores", "usuarios");
                        foreach ($gestion as $k => $v) {
                            echo "
                                    <tr>\n
                                        <form action='http://localhost/gesventa/panel.php' method='POST'></form>\n
                                        <td>$v</td>\n
                                        <td>\n
                                            <select name='accion'>\n
                                                <option value='query'>CONSULTAR</option>\n
                                                <option value='insert'>NUEVO REGISTRO</option>\n
                                            </select>\n
                                        </td>\n
                                        <input type='hidden' name='table' value='$v'>\n
                                        <td><input type='submit' value='IR'></td>\n
                                    </tr>\n
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </fieldset>
            <fieldset>
                <legend>Filtros: </legend>
                <strong>productos: query</strong><br>
                <table>
                    <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                    <tbody>
                        <?php
                        $info = array(
                            "cod" => "number", "nom_prod" => "text", "pvp" => "number",
                            "prov" => "text", "imagen" => "text", "existencias" => "number"
                        );
                        foreach ($info as $k => $v) {
                            echo "
                                    <tr>
							            <td><label for='$k'>$k</label></td>
							            <td><input type='$v' name='fields[$k]'></td>
						            </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
                <input type="hidden" name="table" value="productos">
                <input type="hidden" name="accion" value="query">
                <br><input type="submit" value="ENVIAR" style="float:right;">
            </fieldset>
        </div>
        <div id="cuerpo" style="width:70%; float:left;">
            <fieldset>
                <legend>Resultados: </legend>
                <h3>RESULTADOS</h3>
                <table style="border: none; width:100%;">
                    <tbody>
                        <?php
                        $prods = array(
                            "1" => array("name" => "Z323", "price" => "71.90", "cod" => "J04131348", "img" => "auriculares-mp3.jpg"),
                            "2" => array("name" => "Z623", "price" => "209.00", "cod" => "J04131348", "img" => "batmanbot.jpeg"),
                            "3" => array("name" => "Z906", "price" => "399.00", "cod" => "J04131348", "img" => "cargador.jpg"),
                            "4" => array("name" => "Z506", "price" => "125.00", "cod" => "J04131348", "img" => "auriculares-mp3.jpg"),
                            "11" => array("name" => "Argon", "price" => "50.00", "cod" => "D7767763A", "img" => "regulador-botella-argon.jpg"),
                            "12" => array("name" => "Neon", "price" => "35.00", "cod" => "D7767763A", "img" => "neon.jpg"),
                            "13" => array("name" => "Ocelote", "price" => "59.90", "cod" => "D7767763A", "img" => "raton-ocelote-gaming.jpg"),
                            "22" => array("name" => "Death Stalker", "price" => "299.99", "cod" => "P3941094I", "img" => "razer-deathstalker-chroma-keyboard.jpg"),
                            "23" => array("name" => "Orb Weaver", "price" => "129.99", "cod" => "P3941094I", "img" => "orbweaverchroma.png"),
                            "24" => array("name" => "Black Widow", "price" => "149.00", "cod" => "P3941094I", "img" => "envy-phoenix-810-401lns.jpg"),
                            "31" => array("name" => "Envy Phoenix 810-401ns", "price" => "2599.00", "cod" => "A36109494", "img" => "envy-phoenix-810-401lns.jpg"),
                            "32" => array("name" => "Envy Recline 23-k301ns", "price" => "1399.00", "cod" => "A36109494", "img" => "pavillon-500-354ns.jpg"),
                            "33" => array("name" => "Pavillon 500-354ns", "price" => "499.00", "cod" => "A36109494", "img" => "pavillon-500-354ns.jpg"),
                        );
                        foreach ($prods as $k => $v) {
                            $txt = "
                                    <tr style='padding: 0 20% 0 0;>\n
                                    <form action='http://localhost/gesventa/panel.php' method='POST'></form>\n
                                    <td style='left:10px;'>$k</td>\n
                            ";
                            foreach ($v as $subK => $subV) {
                                $txt .= "
                                    <td style='left:10px;'>$subV</td>\n
                                ";
                            }
                            $txt .= "
                                    <td>\n
                                        <select name='uds'>\n
                                            <option value='0' selected=''>0</option>\n
                            ";
                            if ($k == 11 || $k == 13 || $k == 23 || $k == 31 || $k == 33) {
                                for ($i = 1; $i <= 5; $i++) {
                                    $txt .= "<option value='$i'>$i</option>\n";
                                }
                            }
                            $txt .= "
                                        </select>\n
                                    </td>\n
							        <td><br><input type='submit' name='$k' value='AÑADIR'></td>\n
							        <input type='hidden' name='prod' value='$k'>\n
                                ";
                            echo $txt;
                        }
                        ?>
                    </tbody>
                </table>
        </div>
</body>

</html>