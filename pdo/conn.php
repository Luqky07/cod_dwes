<?php
//conn.php
require_once 'emple.inc.php';

class Conn{
	
	//clase que devuelve una sola conexión
	//utilizamos el patrón Singleton
	
	//'mysql:dbname=empresa; host=localhost; charset=utf8'
	private $host= HOST; 		//'localhost';
	private $db= BD; 			//'empresa';
	private $chrst= CHRST; 	//'utf8';
	private $user= USER; 		//'root';
	private $pwd= PWD;			//'root';
	private static $conn; //objeto PDO que vamos a devolver
	
	function getConn(){
		
		$conn_str= 'mysql:dbname='.$this->db;
		$conn_str.='; host='.$this->host;
		$conn_str.='; charset='.$this->chrst;
		//echo $conn_str;
	try{
			
		Conn::$conn= new PDO(
				$conn_str, $this->user, $this->pwd);
		
			//ahora, podemos configurar otros aspectos
			//del objeto PDO
			
		Conn::$conn->setAttribute(
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION
		);
				
	}catch (PDOException $e){
		
		die("<br/>ERROR: ".$e->getMessage());
	}

	return Conn::$conn;	
}//getConn

function close(){
	Conn::$conn= null;
}	
	
}//class
//Ejemplo básico para ver si conecta y ejecuta SQL
try{
	
	$c= new Conn();		
	$bd= $c->getConn();
	echo "<h1>Conectado</h1>";
	
	//consultamos los usuarios de mysql
	
	$sql= "SELECT * FROM empleados";
	$users= $bd->query($sql);
	echo "</br>".$users->rowCount();
	
	$c->close();
	
}catch(PDOException $e){
	echo "<h1>Error</h1>";
}


