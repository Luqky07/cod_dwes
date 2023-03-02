<?php

require_once("conn.inc.php");

/*
Clase de tipo DAO que solo contiene métodos para gestionar las operaciones CRUD sobre la 
tabla de PRODUCTOS
*/
class ProductoDAO
{
    //Constructor vacio
    public function __construct()
    {
    }

    //Devuelve un array con todos los valores de la tabla mediante una query sin preparar
    public function getAll()
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
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

    //Devuelve un único producto recibiendo por parámetro su clave primaria
    public function get($key)
    {
        $mssg = null;
        if (!isset($key)) $mssg = "fail";
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
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
        else return $res[0];
    }

    /*
    Devuelve un array con un conjunto de productos en función de un array con claves
    primarias
    */
    public function gets($keys)
    {
        if (!isset($keys)) $mssg = "fail";
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "SELECT * FROM PRODUCTOS WHERE COD IN (";
            $values = [];
            foreach ($keys as $v) {
                $q .= ":$v, ";
                $values[":$v"] = $v;
            }
            $q = substr($q, 0, -2);
            $q .= ")";
            $stmt = $bd->prepare($q);
            $stmt->execute($values);
            $filterProds = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Fetch como traducción sería ir a una ubicación conocida y traer algo
        } catch (PDOException $e) {
            $mssg = "fail";
        } finally {
            $dbh->close();
        }
        if (isset($mssg)) return $mssg;
        else return $filterProds;
    }

    /*
    Recibe por parámetros todos los campos de la tabla PRODUCTOS y un array que contiene
    los filtros para preparar la sentencia en función de los datos recibidos y luego
    ejecutarla
    */
    public function getFilter($datos, $allFieldsProd)
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "SELECT * FROM PRODUCTOS WHERE";
            $allEmpty = true;
            foreach (array_keys($allFieldsProd) as $k) {
                if (!empty($datos["filter_" . $k]) && $k != "imagen") {
                    $allEmpty = false;
                    if ($k == "pvp" || $k == "existencias") {
                        $q .= " $k >= :$k AND";
                    } else if ($k == "nom_prod" || $k == "prov") {
                        $q .= " $k LIKE :$k AND";
                    } else {
                        $q .= " $k = :$k AND";
                    }
                }
            }
            $q = substr($q, 0, -3);
            $values = [];
            foreach (array_keys($allFieldsProd) as $k) {
                if (!empty($datos["filter_" . $k]) && $k != "imagen") {
                    if ($k == "nom_prod" || $k == "prov") $values[":" . $k] = "%" . $datos["filter_" . $k] . "%";
                    else $values[":" . $k] = $datos["filter_" . $k];
                }
            }
            $stmt = $bd->prepare($q);
            $stmt->execute($values);
            $filterProds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            if ($allEmpty == true) return $this->getAll();
            else return NULL;
        } finally {
            $dbh->close();
        }
        return $filterProds;
    }

    /*
    Recibe por parámetros la información del producto y todos los campos de la tabla
    PRODUCTOS y realiza una inserción a la base de datos preparando la sentencia con los
    datos del producto recibido y luego ejecutandola. Para insertar un nuevo producto
    el campo de la clave primaria se registra llamando a una función que devuelve el 
    último valor de la clave primaria y le suma uno
    */
    public function insert($datos, $allFieldsProd)
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "INSERT INTO PRODUCTOS (cod";
            foreach (array_keys($allFieldsProd) as $k) {
                if (!empty($datos["new_" . $k]) && $k != "imagen") $q .= ", " . $k;
            }
            $q .= ") values (" . $this->lastCod() + 1;
            foreach (array_keys($allFieldsProd) as $k) {
                if (!empty($datos["new_" . $k]) && $k != "imagen") $q .= ", '" . $datos["new_" . $k] . "'";
            }
            $q .= ")";
            $bd->query($q);
            return "insert_valid";
        } catch (PDOException $e) {
            echo $e . BR;
            return "insert_Fail";
        } finally {
            $dbh->close();
        }
    }

    /*
    Devuelve el valor de la clave primaria del último producto de la tabla PRODUCTOS
    */
    public function lastCod()
    {
        try {
            $dbh = new Conn();
            $bd = $dbh->getConn();
            $q = "SELECT MAX(cod) last FROM PRODUCTOS";
            $cods = $bd->query($q);
            $maxCod =  $cods->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return NULL;
        } finally {
            $dbh->close();
        }
        return $maxCod[0]["last"];
    }
}
