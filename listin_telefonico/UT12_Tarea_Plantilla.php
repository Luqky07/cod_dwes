<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
		Desarrollo Web en Entorno Servidor - Tarea 1 
		Programar una aplicación para mantener una lista de teléfonos en una única página web, programada en PHP.
		La lista almacenará únicamente dos datos: número de teléfono y nombre. No podrá haber números repetidos.
		Se utilizará como modelo de datos un array de pares (teléfono, nombre)
		En la parte superior de la página web se mostrará un título y los resultados obtenidos
		En la parte inferior tendremos un sencillo formulario, una casilla de texto para el teléfono y otra para el nombre.
		Al pulsar el botón, se ejecutará alguna de las siguientes acciones:
				•	Si el número está vacío o no cumple el patrón de validación especificado, se mostrará una advertencia.
				•	Si se introduce un número válido que no existe en la lista, y el nombre  no está vacío, se añadirá a la lista.
				•	Si se introduce un número válido que existe en la lista y se indica un nombre, se sustituirá el nombre anterior.
				•	Si se introduce un número válido que existe en la lista pero sin nombre, se eliminará el teléfono de la lista
				•	Si se introduce un nombre que exista dejando el teléfono en blanco, se visualizará una lista con todos los teléfonos asociados
		
		Como mecanismo de "persistencia" utilizaremos un array que está en el formulario como elemento oculto y se envía.
		
		Consultar y comprender el funcionamiento de métodos: explode, implode, array_search >> utilizados en el código		
-->
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Listín telefónico</title>
	<!-- Preparamos el entorno gráfico para los datos -->
	<style type="text/css">
		td,
		th {
			border: 1px solid grey;
			padding: 4px;
		}

		th {
			text-align: center;
			background-color: #67b4b4;
		}

		table {
			border: 1px solid black;
		}

		div {
			padding: 10px 20px
		}

		h1 {
			font-family: sans-serif;
			font-style: italic;
			text-transform: capitalize;
			color: #008000;
		}

		.bajoDch {
			float: right;
			position: absolute;
			margin-right: 0px;
			margin-bottom: 0px;
			bottom: 0px;
			right: 0px;
		}

		.altoDch1 {
			color: #00f;
			float: right;
			position: absolute;
			margin-right: 0px;
			margin-top: 0px;
			top: 0px;
			right: 0px;
		}

		.altoDch2 {
			color: #f00;
			float: right;
			position: absolute;
			margin-right: 0px;
			margin-top: 0px;
			top: 0px;
			right: 0px;
		}
	</style>
</head>

<body>
	<?php
	define("BR", "<br/>\n");
	// Comprobamos que se han recibido los datos 'anteriores' por POST
	if (!empty($_POST["personas"])) {
		$tel = $_POST["tfno"];
		$name = $_POST["nom"];
		$array = explode(",", $_POST["personas"]);
		$pos = count($array);
		$txt = "<ul style='list-style: none;'>\n";
		for ($i = 1; $i < $pos; $i += 2) {
			$txt .= "<li><strong>" . $array[$i + 1] . "</strong> = " . $array[$i]."</li>\n";
		}
		$txt .= "<li><strong>$name</strong> = $tel</li>\n";
		$txt .= "</ul>";
		echo $txt;
		if (empty($tel)) {
			if (findPos($array, $name) !== false) {
				for ($i = 1; $i < count($array); $i += 2) {
					echo $array[$i] . " = " . $array[$i + 1] . BR;
				}
			}
		} else {
			if (!preg_match("/[\d]{9}/", $tel)) {
				echo "El campo teléfono no cumple con los requisitos, está vacio o no es un número válido" . BR;
			} else {
				$busqueda = findPos($array, $tel);
				if ($busqueda === false && !empty($name)) {
					$array[$pos++] = $tel;
					$array[$pos++] = $name;
				} else {
					if (!empty($name)) {
						$array[$busqueda + 1] = $name;
					} else {
						unset($array[$busqueda]);
						unset($array[$busqueda + 1]);
					}
				}
			}
		}
	} else {
		// Si no hay datos antiguos, sólo reiniciamos las variables globales
		$array = array();
		$pos = 0;
		echo "<h2>NO HAY DATOS</h2>";
	}
	//Implementar la funcionalidad solicitada

	// Función para comprobar si un nombre existe en el array
	function findPos($miArray, $dato)
	{
		$posicion = array_search($dato, $miArray, false);
		return $posicion;
	}
	?>
	<br />
	<!-- Capa inferior derecha para las preguntas -->
	<div class="bajoDch">
		<!-- Formulario para enviar sus datos por POST a la misma página -->
		<form name="formulario" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<table style="border: 0px;">
				<tr style="background-color: #8080ff;">Introduzca los datos

					<!-- Número de teléfono -->
					<td>
						<fieldset>
							<legend>Teléfono</legend>
							<input name="tfno" type="text" />
						</fieldset>
					</td>
					<!-- Nombre de la persona -->
					<td>
						<fieldset>
							<legend>Nombre</legend>
							<input name="nom" type="text" />
						</fieldset>
					</td>
				</tr>
			</table>
			<!-- Creamos un campo oculto para enviar los datos ya recogidos con anterioridad -->
			<input name="personas" type="hidden" value="
				<?php
				if (isset($array)) echo implode(",", $array);
				?>" style="text-align:right;" />
			<!-- Enviamos los datos del formulario -->
			<input type="submit" value="Aplicar cambios" />
		</form>
	</div>
</body>

</html>