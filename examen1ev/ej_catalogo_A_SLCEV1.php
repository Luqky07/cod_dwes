<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTIÓN DE VENTASFORM-/ut3/put3/index.php</title>
</head>

<body>
    <header style="width:100%; height:20%; text-align:center; margin:1%;">
        <h1>SLCEV1</h1>
    </header>
    <br>
    <div style="width:100%; height:20%; text-align:center; margin:1%;">
        <h1>BIENVENIDO a GESVENTAS</h1>
        <?php
        define("BR", "<br/>\n");
        $nav = array("login" => "LOGIN", "registro" => "REGISTRARSE", "logout" => "LOGOUT", "index" => "INICIO");
        $txt = "";
        foreach ($nav as $k => $v) {
            $txt .= "<a href=http://localhost/gesventa/$k.php style='margin: 0% 3%;'>$v</a>\n";
        }
        echo $txt;
        ?>
        <!--
        <a href="http://localhost/gesventa/login.php" style="margin: 0% 3%;">LOGIN</a>
		<a href="http://localhost/gesventa/registro.php" style="margin: 0% 3%;">REGISTRARSE</a>
		<a href="http://localhost/gesventa/logout.php" style="margin: 0% 3%;">LOGOUT</a>
		<a href="http://localhost/gesventa/index.php" style="margin: 0% 3%;">INICIO</a>
        -->

    </div>
    <div style="overflow:hidden; width:100%; height:80%;">
        <div id="tables" style="float:left; width:30%; ">
            <form action="http://localhost/ut3/put3/index.php" method="POST">
                <!--target="_blank"-->
            </form>
            <fieldset>
                <legend>Gestionar: </legend>

                <table>
                    <tbody>
                        <?php
                        $gestion = array("clientes", "facturas", "productos");
                        $txt = "";
                        foreach ($gestion as $v) {
                            $txt .= "<tr>\n<form action='http://localhost/gesventa/panel.php' method='POST'></form>\n";
                            $txt .= "<td>$v</td>\n";
                            $txt .= "<td><select name='accion'>\n
                                            <option value='query'>CONSULTAR</option>\n
                                            <option value='insert'>NUEVO REGISTRO</option>\n
                                        </select></td>\n
                                    <input type='hidden' name='table' value='clientes'>\n
                                    <td><input type='submit' value='IR'></td>\n</tr>";
                        }
                        echo $txt;
                        ?>
                        <!-- <tr>
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td>clientes</td>
                            <td><select name="accion">
                                    <option value="query">CONSULTAR</option>
                                    <option value="insert">NUEVO REGISTRO</option>
                                </select></td>
                            <input type="hidden" name="table" value="clientes">
                            <td><input type="submit" value="IR"></td>
                        </tr>
                        <tr>
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td>facturas</td>
                            <td><select name="accion">
                                    <option value="query">CONSULTAR</option>
                                    <option value="insert">NUEVO REGISTRO</option>
                                </select></td>
                            <input type="hidden" name="table" value="facturas">
                            <td><input type="submit" value="IR"></td>
                        </tr>
                        <tr>
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td>productos</td>
                            <td><select name="accion">
                                    <option value="query">CONSULTAR</option>
                                    <option value="insert">NUEVO REGISTRO</option>
                                </select></td>
                            <input type="hidden" name="table" value="productos">
                            <td><input type="submit" value="IR"></td>
                        </tr> -->
                    </tbody>
                </table>
            </fieldset>

            <div>
                <fieldset>
                    <legend>Filtros: </legend>
                    <strong>productos: query</strong><br>
                    <table>
                        <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                        <tbody>
                            <?php
                            $filtros = array("cod" => "number", "nom_prod" => "text", "pvp" => "number", "existencias" => "number");
                            $txt = "";
                            foreach ($filtros as $k => $v) {
                                $txt .= "<tr>\n<td><label for='$k'>$k</label></td>\n";
                                $txt .= "<td><input type='$v' name='fields[$k]'></td>\n</tr>\n";
                            }
                            echo $txt;
                            ?>
                            <!-- <tr>
                                <td><label for="cod">cod</label></td>
                                <td><input type="number" name="fields[cod]"></td>
                            </tr>
                            <tr>
                                <td><label for="nom_prod">nom_prod</label></td>
                                <td><input type="text" name="fields[nom_prod]"></td>
                            </tr>
                            <tr>
                                <td><label for="pvp">pvp</label></td>
                                <td><input type="number" name="fields[pvp]"></td>
                            </tr>
                            <tr>
                                <td><label for="existencias">existencias</label></td>
                                <td><input type="number" name="fields[existencias]"></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <input type="hidden" name="table" value="productos">
                    <input type="hidden" name="accion" value="query">
                    <br><input type="submit" value="ENVIAR" style="float:right;">

                </fieldset>
            </div>
        </div>

        <div id="cuerpo" style="width:70%; float:left;">
            <fieldset>
                <legend>Resultados: </legend>
                <h3>RESULTADOS</h3>

                <br>
                <b>Warning</b>: Undefined array key "rol" in <b>C:\xtina\xampp\htdocs\gesventa\panel.php</b> on line
                <b>139</b><br>
                <table style="border: none; width:100%;">
                    <tbody>
                        <?php
                        $prods = array(
                            "1" => array("nom" => "Z323", "precio" => "71.90", "cod" => "J04131348", "img" => "auriculares-mp3.jpg", "uds" => "5"),
                            "2" => array("nom" => "Z623", "precio" => "209.00", "cod" => "J04131348", "img" => "batmanbot.jpeg", "uds" => "5"),
                            "3" => array("nom" => "Z906", "precio" => "399.00", "cod" => "J04131348", "img" => "cargador.jpg", "uds" => "5"),
                            "4" => array("nom" => "Z506", "precio" => "125.00", "cod" => "J04131348", "img" => "auriculares-mp3.jpg", "uds" => "0"),
                            "23" => array("nom" => "Orb Weaver", "precio" => "129.99", "cod" => "P3941094I", "img" => "orbweaverchroma.png", "uds" => "0"),
                            "24" => array("nom" => "Black Widow", "precio" => "149.00", "cod" => "P3941094I", "img" => "envy-phoenix-810-401lns.jpg", "uds" => "0")
                        );
                        $txt = "";
                        foreach ($prods as $k => $v) {
                            $txt .= "<tr style='padding: 0 20% 0 0;'>\n<form action='http://localhost/gesventa/panel.php' method='POST'></form>\n";
                            $txt .= "<td style='left:10px;'>$k</td>\n";
                            $txt .= "<td style='left:10px;'>" . $v["nom"] . "</td>\n";
                            $txt .= "<td style='left:10px;'>" . $v["precio"] . "</td>\n";
                            $txt .= "<td style='left:10px;'>" . $v["cod"] . "</td>\n";
                            $txt .= "<td style='left:10px;'>" . $v["img"] . "</td>\n";
                            $txt .= "<td><select name='uds'>\n<option value='0' selected=''>0</option>\n";
                            for ($i = 1; $i <= $v["uds"]; $i++) {
                                $txt .= "<option value='$i'>$i</option>\n";
                            }
                            $txt .= "</select></td>\n
                                    <td><br><input type='submit' name='$k' value='AÑADIR'></td>\n
                                    <input type='hidden' name='prod' value='$k'>\n</tr>\n";
                        }
                        echo $txt;
                        ?>
                        <!-- <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">1</td>
                            <td style="left:10px;">Z323</td>
                            <td style="left:10px;">71.90</td>
                            <td style="left:10px;">J04131348</td>
                            <td style="left:10px;">auriculares-mp3.jpg</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select></td>
                            <td><br><input type="submit" name="1" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="1">

                        </tr>
                        <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">2</td>
                            <td style="left:10px;">Z623</td>
                            <td style="left:10px;">209.00</td>
                            <td style="left:10px;">J04131348</td>
                            <td style="left:10px;">batmanbot.jpeg</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select></td>
                            <td><br><input type="submit" name="2" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="2">

                        </tr>
                        <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">3</td>
                            <td style="left:10px;">Z906</td>
                            <td style="left:10px;">399.00</td>
                            <td style="left:10px;">J04131348</td>
                            <td style="left:10px;">cargador.jpg</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select></td>
                            <td><br><input type="submit" name="3" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="3">

                        </tr>
                        <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">4</td>
                            <td style="left:10px;">Z506</td>
                            <td style="left:10px;">125.00</td>
                            <td style="left:10px;">J04131348</td>
                            <td style="left:10px;">auriculares-mp3.jpg</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                </select></td>
                            <td><br><input type="submit" name="4" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="4">

                        </tr>


                        </tr>
                        <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">23</td>
                            <td style="left:10px;">Orb Weaver</td>
                            <td style="left:10px;">129.99</td>
                            <td style="left:10px;">P3941094I</td>
                            <td style="left:10px;">orbweaverchroma.png</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                </select></td>
                            <td><br><input type="submit" name="23" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="23">

                        </tr>
                        <tr style="padding: 0 20% 0 0;">
                            <form action="http://localhost/gesventa/panel.php" method="POST"></form>
                            <td style="left:10px;">24</td>
                            <td style="left:10px;">Black Widow</td>
                            <td style="left:10px;">149.00</td>
                            <td style="left:10px;">P3941094I</td>
                            <td style="left:10px;">envy-phoenix-810-401lns.jpg</td>
                            <td><select name="uds">
                                    <option value="0" selected="">0</option>
                                </select></td>
                            <td><br><input type="submit" name="24" value="AÑADIR"></td>
                            <input type="hidden" name="prod" value="24">


                        </tr> -->
                    </tbody>
                </table>


            </fieldset>

        </div>

    </div>

</body>

</html>