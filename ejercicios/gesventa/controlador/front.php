<!DOCTYPE html>
<?php
//Antes de cualquier declaración HTML o PHP iniciaremos la sesión
session_start();

/*
En el caso de que nuestra sesión no tenga almacenado el nombre de usuario se interpretará
como que se ha saltado la página de login.php y se hará una redirección a la misma para
que el usuario se registre correctamente
*/
if (!isset($_SESSION["user"])) header("Location: login.php")
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos <?php echo $_SESSION['user'] ?></title>
</head>

<body>
    <?php
    //Importamos los archivos necesarios
    require_once("../vista/vista.inc.php");
    require_once("../modelo/productoDAO.inc.php");
    require_once("../modelo/model.inc.php");

    //Creamos los objetos Vista y ProductoDAO
    $v = new Vista();
    $p = new ProductoDAO();
    $m = new Modelo();

    /*
    Si se ha pulsado el botón para cambiar el idioma, también se cambiará el idioma el objeto
    vista, en caso contrario si ya hay un idioma almacenado en la sesión también cambiaremos
    el idioma del objeto Vista
    */
    if (isset($_POST['idiom'])) $v->setLang($_POST["lang"]);
    else if (isset($_SESSION["lang"])) $v->setLang($_SESSION["lang"]);

    //Se almacena en la sesión el idioma que se está utilizando
    $_SESSION["lang"] = $v->getLang();

    //En esta variable almacenamos todos los campos de la tabla productos
    $allFieldsProd = $m->allFields("productos");

    /*
    En el caso de que se haya pulsado el botón correspondiente para añadir un nuevo
    producto se llamará a la función intert del objeto ProductoDAO para añadir el
    nuevo producto a la base de datos, y se hará una redirección a la misma página para
    borrar el POST y evitar que en caso de recargar la página se añadan nuevos productos
    con los mismos datos
    */
    if (isset($_POST["newProd"])) {
        $p->insert($_POST, $allFieldsProd);
        header("Location: front.php");
    }

    /*
    En caso de que se pulse el botón para buscar por filtros guardaremos en una varaible
    un array con los datos que la base de datos nos ha devuelto aplicando esos filtros
    En caso contrario, se guardaran los datos de todos los productos 
    */
    if (isset($_POST['search'])) $prods = $p->getFilter($_POST, $allFieldsProd);
    else $prods = $p->getAll();

    /*
    En caso de que se pulse el botón para añadir un producto al carrito en la variable
    $info guardaremos la información del código del producto y la cantidad que se quiere
    añadir, en el caso de que ya exista una cookie del usuario guardaremos esa cookie en
    forma de array mediante la función unserialize, en caso contrario crearemos un array
    nuevo, si en el array existe información de un producto se sumara la cantidad de
    productos que queremos añadir a la que ya había.
    En caso de que ese producto no se haya registrado guarademos la cantidad de producto
    que se quieran comprar como un Integer.
    Modificaremos o crearemos una nueva cookie que guardará la información de los objetos
    que tenemos en nuestro carrito haciendo uso de la función serialize para serializar
    el array y que sea posible guardarlo en una cookie.
    Por último hace una redirección a la página para evitar que al recargar la página se
    detecte que se ha pulsado el botón para añadir al carrito se añada la misma cantidad
    de productos
    */
    if (isset($_POST["addProduct"])) {
        $info = explode("_", $_POST['num_prods']);

        if (isset($_COOKIE[$_SESSION["user"] . "_cart"])) $cart = unserialize($_COOKIE[$_SESSION["user"] . "_cart"]);
        else $cart = [];
        
        if (isset($cart[$info[0]])) $cart[$info[0]] += $info[1];
        else $cart[$info[0]] = (int) $info[1];
        
        setcookie($_SESSION["user"] . "_cart", serialize($cart), time() + (86400 * 30), "/");
        header("Location: front.php");
    }

    /*
    En caso de que haya filtrado anteriormente o se pulse el botón para activar los
    filtros, o si se ha pulsado el botón para añadir un nuevo producto se modificará
    la variable $seccion que será la que se encargue de controlar que se muestra en el
    div de secciones.
    */
    if (isset($_POST["retrieve"]) || isset($_POST["search"])) $seccion = "filter";
    else if (isset($_POST["new"])) $seccion = "new";
    else $seccion = null;

    /*
    Se imprimirá la cabecera de la página mediante la clase Vista, enviando como
    parámetros el nombre de usuario y la dirección de la página
    */
    echo $v->cabecera($_SESSION["user"], $_SERVER['PHP_SELF']);

    //Se almacenarán todos los proveedores de productos
    $provs = $p->getAllProvs();

    //Se imprimirá todo el contenido de la página mediante la clase Vista
    echo $v->frontArticle($prods, $allFieldsProd, $seccion, $provs);
    ?>
</body>

</html>