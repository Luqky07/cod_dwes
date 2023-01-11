<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //Operaciones CRUD

    define("BR","<br>\n");
    $array = array("foo", "bar", "hola", "mundo");//Create
    var_dump($array);//Retrieve (acceder al contenido)
    echo BR.BR;
    $array[2] = "adios";//Update
    var_dump($array);
    echo BR.BR;
    $array[] = "prueba";//Update
    var_dump($array);
    echo BR.BR;
    unset($array[0]);
    var_dump($array);//Delete
    ?>
</body>

</html>