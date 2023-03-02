<?php
require_once("conn.inc.php");

/*
Contiene métodos que requieren conxeción a la BD y que no tienen que ver con la tabla
PRODUCTOS
*/
class Modelo
{
    //Constructor vacio
    public function __construct()
    {
    }

    /*
    Esta función permite validar un usuario y su contraseña para poder acceder a la 
    aplicación web. Siempre devuelve un string, en caso de que funcione correctamente
    estará vacio y si ha ocurrido un error devolverá el error de forma diferente en función
    de si no hay datos o de si la sentencia genera un error
    */
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

    //Función que devuelve el ROL de un USUARIO
    function getUsrRoll($usr)
    {
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
        if (isset($mssg)) return $mssg;
        else return $rol[0]["rol"];
    }

    /*
    Función que devuelve el nombre de todos los campos de una tabla y el tipo de dato del 
    campo de la tabla que recibe por parámetro 
    */
    public function allFields($table)
    {
        $consult = [];
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "DESCRIBE $table";
            $prods = $bd->query($q);
            $consult = $prods->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        $res = [];
        /*
        $consult contiene un array con toda la información de las tablas, el valor Type del
        array contiene la información del tipo y la longitud que tiene, por eso hay que
        separar ese valor y solo coger la parte que indica el tipo, y ese valor se guarda
        en un array asociativo en el que en cada campo ("Field" del array $consult) se le
        asocia el tipo correspondiente
        */
        foreach ($consult as $v) {
            $type = explode("(", $v["Type"])[0];
            $res[$v["Field"]] = $type;
        }
        return $res;
    }

    //Función que devuelve todos los CIF de la tabla PROVEEDORES
    public function getAllProvs()
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "SELECT cif FROM PROVEEDORES";
            $provs = $bd->query($q);
            $allProvs =  $provs->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        return $allProvs;
    }
}
