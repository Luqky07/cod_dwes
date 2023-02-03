<?php
//Clase de tipo DAO que gestiona operaciones CRUD sobre la tabla de PRODUCTOS

require_once("conn.inc.php");

class ProductoDAO
{
    public function __construct()
    {
    }

    public function getAll()
    {
        //Método que DEVUELVE un ARRAY con TODOS los Productos de la tabla
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();

            //Consulta SIN PREPARAR
            $q = "SELECT * FROM PRODUCTOS";
            $prods = $bd->query($q);
            $allProds =  $prods->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        return $allProds;
    }

    public function get($key)
    {
        /*
        Método que:
            1. RECIBE un dato con el COD de un Producto.
            2. DEVULVE el Producto asociado a ese campo COD.
        */
        $mssg = null;
        if (!isset($key)) $mssg = "fail";
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn(); //referencia a la BD
            $stmt = $bd->prepare("SELECT * FROM PRODUCTOS WHERE COD = :cod");
            $stmt->execute([':cod' => $key]);
            if ($stmt->rowCount() != 1) $mssg = "fail";
            else $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $mssg = "fail";
        } finally {
            $dbh->close();
        }
        if (isset($mssg)) return $mssg;
        else return $res;
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
    public function filter($datos)
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();

            //Consulta SIN PREPARAR
            $q = "SELECT * FROM PRODUCTOS WHERE";
            $allFields = $this->allFields("productos");
            $firstOpt = true;
            foreach ($allFields as $k => $v) {
                if (!empty($datos["filter_" . $k]) && $k != "imagen") {
                    if ($firstOpt) {
                        $q .= " $k = :$k";
                        $firstOpt = false;
                    } else $q .= " AND $k = :$k";
                }
            }
            foreach ($allFields as $k => $v) {
                if (!empty($datos["filter_" . $k]) && $k != "imagen") {
                    $values[":" . $k] = $datos["filter_" . $k];
                }
            }
            $stmt = $bd->prepare($q);
            $stmt->execute($values);
            $filterProds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        return $filterProds;
    }
}
