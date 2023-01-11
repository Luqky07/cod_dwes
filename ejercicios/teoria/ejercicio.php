<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <?php
    define("BR", "\n");
    /*
    $num = 12345;
    $cuerpo;
    while($num%10!=0){
        $res = $num%10;
        $cuerpo = $res."<br/>".$cuerpo;
        $num /= 10;
    }
    echo $cuerpo;
    */
    $num = intval($_POST["num"]);
    $incio = "<table style = 'border: 2px solid blue;'>";
    if ($num > 0) {
        $cuerpo = "";
        for ($num = $_POST["num"]; $num > 0; $num  = round($num / 10)) {
            $res = $num % 10;
            $cuerpo = BR . "<tr>\n<td style = 'border: 2px solid red;'>". $res . "</td>\n</tr>". $cuerpo;
        }
        $final = BR."</table>";
        echo $incio . $cuerpo . $final;
    } else {
        echo "Vuelve a la pagina anterior y escribe un número mayor a 0";
    }
    ?>
</body>

</html>