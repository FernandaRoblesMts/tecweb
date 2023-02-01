<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"&gt;
<html>
<head>
    <title>Práctica 2</title>
</head>
<body>
    <h2>Inciso 4</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
    $a = 'PHP5 <br>';
    echo $GLOBALS["a"];
    $b = '5ta version de php <br>';
    echo $GLOBALS["b"];
    $c = $b*10;
    echo $GLOBALS["c"];
    $a .= $b;
    $b *= $c;
    $z[0] = 'MySQL <br>';
    echo $GLOBALS["z"];
    
    
    
    
    ?>
    </body>
    </html>