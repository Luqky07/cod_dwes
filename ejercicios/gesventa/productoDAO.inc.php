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
    }
}