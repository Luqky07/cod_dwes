<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>\n");
    /*
    $i=0;
    while($i<5){
        echo $i++.BR;
        if($i==3) break;
    }
    */
    $array;
    for($i=0;$i>10;$i++){
        $array[$i]=($i+1);
    }
    var_dump($array);
    /*
    echo "Primer bucle for break 1".BR;
    for($i=0;$i<4;$i++){
        for($j=0;$j<4;$j++){
            echo "i = $i; j: $j".BR;
            if($j==2) break 1;
        }
    }
    echo "Segundo bulce for break2".BR;
    for($i=0;$i<4;$i++){
        for($j=0;$j<4;$j++){
            echo "i = $i; j: $j".BR;
            if($j==2) break 2;
        }
    }
    */
    ?>
</body>

</html>