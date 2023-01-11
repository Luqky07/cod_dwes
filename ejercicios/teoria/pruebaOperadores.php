<?php
define("BR","<br/>\n");
$cosas = array('',"",array(),'\0',"\0",'0',0,false,true,null,NULL);
foreach ($cosas as $k => $v){
    echo "El elemento $k: \n";
    var_dump($v);
    echo "<ol>\n";
    if(empty($v)) echo "<li>empty</li>\n";
    else echo "<li>NOT empty</li>\n";

    if (isset($v)) echo "<li>isset</li>\n";
    else echo "<li>NOT isset</li>";

    if (is_null($v)) echo "<li>is_null</li>\n";
    else echo "<li>NOT is_null</li>\n";
    echo "</ol>".BR;
}
/*
    ''          empty: true         isset: true
    0           empty: true         isset: true
    array()     empty: true         isset: true
    '\0'        empty: false        isset: true
    false       empty: true         isset: true         PHP lo interpreta como si fuese 0
    null        empty: true         isset: false
*/
