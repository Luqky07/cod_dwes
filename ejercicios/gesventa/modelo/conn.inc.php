<?php
//conn.php
require_once 'emple.inc.php';

/*
Clase que devuelve una sola conexión siguiendo el patrón Singleton mediante el cual se
restringe la creación de objetos de la Conn para garantizar que siempre se devuelve
una única instancia usando constantes del fichero emple.inc.php y atributos estáticos
*/
class Conn
{
	private $host = HOST;
	private $db = BD;
	private $chrst = CHRST;
	private $user = USER;
	private $pwd = PWD;
	//Es el objeto PDO que vamos a devolver
	private static $conn;

	/*
	Devuelve un objeto PDO para establecer conexión con la base de datos que se especifique
	según las constantes que indiquemos
	*/
	function getConn()
	{
		$conn_str = 'mysql:dbname=' . $this->db . '; host=' . $this->host;
		$conn_str .= '; charset=' . $this->chrst;
		try {

			Conn::$conn = new PDO(
				$conn_str,
				$this->user,
				$this->pwd
			);

			Conn::$conn->setAttribute(
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION
			);
		} catch (PDOException $e) {

			die("<br/>ERROR: " . $e->getMessage() . "<br/>");
		}

		return Conn::$conn;
	}

	//Función para cerrar la conexión a la base de datos
	function close()
	{
		Conn::$conn = null;
	}
}
