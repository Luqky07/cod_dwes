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
                $stmt = $bd->prepare("SELECT * FROM usuarios WHERE NOMBRE = :usr AND CLAVE = :pass");
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
}
