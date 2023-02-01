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
            return $prods->fetchAll(PDO::FETCH_ASSOC);
            $dbh->close();
        } catch (PDOException $e) {
            return NULL;
        }
    }

    public function get($key)
    {
        /*
        Método que:
            1. RECIBE un dato con el COD de un Producto.
            2. DEVULVE el Producto asociado a ese campo COD.
        */
        $mssg = null;
        if(!isset($key)) $mssg = "fail";
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

    public function allFields() {
        $mssg = [];
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            //Consulta SIN PREPARAR
            $q = "DESCRIBE PRODUCTOS";
            $prods = $bd->query($q);
            $mssg = $prods->fetchAll(PDO::FETCH_ASSOC);
            $dbh->close();
        } catch (PDOException $e) {
            return NULL;
        }
        $res = [];
        foreach($mssg as $v) {
            $res[] = $v["Field"];
        }
        return $res;
    }
}