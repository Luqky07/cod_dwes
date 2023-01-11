<?php

require_once('..\conn.inc.php');

$c = new Conn();
$bd = $c -> getConn(); //referencia a la BD

//consulta a la BD PREPARADA PORQUE el usuario ESCRIBE DATOS
$stmt=$bd->query("SELECT usr FROM usuarios");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

$ee=$stmt->fetchAll(); //fetch
//var_dump($ee);

//Ponemos a cada usuario el MD5 de su contraseña
//La contraseña es igual que el login

$pstmt=$bd->prepare("UPDATE usuarios SET pass=? WHERE usr=:usr");

foreach($ee as $v){
    echo "<br/>\nusr: ".$v['usr'] ."******* pwd:".md5($v['usr']);
    $pstmt->execute([md5($v['usr']), $v['usr']]);
}


?>