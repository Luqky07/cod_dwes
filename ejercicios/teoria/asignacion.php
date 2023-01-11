<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        $a = 3;
        echo "\$a = ".$a."<br/>";
        $b = &$a;
        echo "\$b = ".$b."<br/>";
        $a = 2;
        echo "\$b = ".$b."<br/>";
        $b = 4;
        echo "\$a = ".$a."<br/>";
    ?>
</body>
</html>