<?php
//schemaDAO.inc.php

/*
    Clase que sigue el patrón DAO
        1. Conecta con una BD relacional
        2. Implementa métodos CRUD:
        getAll, get(key), save(object), update(object), delete(object)
        3. Puede, además, incluir métodos adicionales para comunicarse con la BD

    Su función es DESACOPLAR la conexión entre la app y la BD. De esa forma, si en algún momento queremos
    cambiar el método de persistencia (acceso a datos) de la app, bastará con:
        1. Cambiar la conexión
        2. Implementar estos mismo métodos con la nueva conexión al repositorio de datos
*/

require_once("../../ejercicio6/conn.inc.php");

class SchemaDAO
{
    public function __construct()
    {
    }

    public function getAllTables()
    {
        /*
        Método que DEVUELVE un array con el nombre TODAS las tablas de mi BD
        ToDo
        */
    }

    public function getAllFields($table)
    {
        /*
        Método que:
            1. RECIBE un nombre de tabla
            2. DEVUELVE un ARRAY con el nombre de cada campo de la tabla
        */
    }

    public function execStmt($q)
    {
        /*
        Método que:
            1. RECIBE una sentencia SQL $q SIN PARÁMETROS.
            2. La ejecuta (no preparada).
            3. DEVUELVE el resultado de la ejecución.
        */
    }
}
