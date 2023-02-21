<?php
require_once("conn.inc.php");

class Modelo
{
    //No tiene atributos
    //Contiene métodos que requieren conxeción a la BD
    public function Modelo(){}
    function validar($datos)
    {
        $mssg = "";
        if ($datos['user'] == "" or $datos['pass'] == '') {
            $mssg = "nodata";
        } else {
            try {
                $c = new Conn();
                $bd = $c->getConn(); //referencia a la BD
                $stmt = $bd->prepare("SELECT * FROM usuarios WHERE USR = :usr AND PASS = :pass");
                $stmt->execute([':usr' => $datos['user'], ':pass' => md5($datos['pass'])]);
                if ($stmt->rowCount() != 1)
                    $mssg = "fail";
            } catch (PDOException $e) {
                $mssg = "fail";
            } finally {
                $c->close();
            }
        }
        return $mssg;
    }

    function getUsrRoll($usr) {
        $mssg = null;
        if (!isset($usr)) {
            $mssg = "nouser";
        } else {
            try {
                $c = new Conn();
                $bd = $c->getConn();
                $stmt = $bd->prepare("SELECT rol FROM usuarios WHERE USR = :usr");
                $stmt->execute([':usr' => $usr]);
                $rol = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $mssg = "fail";
            } finally {
                $c->close();
            }
        }
        if(isset($mssg)) return $mssg;
        else return $rol[0]["rol"];
    }

    public function allFields($table)
    {
        $mssg = [];
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            //Consulta SIN PREPARAR
            $q = "DESCRIBE $table";
            $prods = $bd->query($q);
            $mssg = $prods->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        $res = [];
        foreach ($mssg as $v) {
            $type = explode("(", $v["Type"]);
            $res[$v["Field"]] = $type[0];
        }
        return $res;
    }

}
