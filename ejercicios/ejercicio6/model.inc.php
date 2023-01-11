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
            $mssg = "Es obligatorio introducir datos";
        } else {
            try {
                $c = new Conn();
                $bd = $c->getConn(); //referencia a la BD

                $stmt = $bd->prepare("SELECT * FROM usuarios WHERE usr=:usr AND pass=pass");
                $stmt->execute([':usr' => $datos['user'], ':pass' => md5($datos['pass'])]);
                if ($stmt->rowCount() != 1)
                    $mssg = "ERROR";
            } catch (PDOException $e) {
                echo "Usuario y contraseña incorrectos <br/>\n";
            } finally {
                $c->close();
            }
            return $mssg;
        }
    }
}
