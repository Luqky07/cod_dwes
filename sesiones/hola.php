<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php
	$colores = ["b" => "blue", "r" => "red", "y" => "yellow"];
	$mssgs = [
		"es" => ["entrar" => "Bienvenido", "salir" => "Hasta pronto"],
		"en" => ["entrar" => "Welcome", "salir" => "Goodbye"],
		"fr" => ["entrar" => "Bienvenu", "salir" => "Au revoir"]
	];
	echo "<body bgcolor='".$colores[$_SESSION['color']]."'>\n";

	//recibimos diferentes valores de personalización
	//y personalizamos la página

	if (!isset($_SESSION['user'])) {
		//si no existen las variables de sesión
		echo "NO puedes entrar en la página<br/>";
	} else {
		echo "<h3>".$mssgs[$_SESSION['lang']]['entrar'].", ".$_SESSION['user']."</h3>\n";
		//echo "BIENVENIDO, " . $_SESSION['user'] . "<br/>";
	}
	echo "<a href='ses_6_login.php'>".$mssgs[$_SESSION['lang']]['salir']."</a>\n";
	//echo "<a href='ses_6_login.php'>VOLVER</a><br/>";
	?>
</body>

</html>