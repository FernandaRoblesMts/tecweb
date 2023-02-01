<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"&gt;
<html>
<head>
    <title>Práctica 2</title>
</head>
<body>
    <h2>Inciso 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
    $a = '0';
    $b = 'TRUE';
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);
    $g = 'El valor de a es';
    $valorb = 'El valor de b es ';
    $valorc = 'El valor de c es ';
    $valord = 'El valor de d es ';
    $valore = 'El valor de e es ';
    $valorf = 'El valor de f es ';
    $espacio = '<br>';
    echo $g;
    var_dump($a);
    echo $espacio;
    echo $valorb;
    var_dump($b);
    echo $espacio;
    echo $valorc;
    var_dump($c);
    echo $espacio;
    echo $valord;
    var_dump($d);
    echo $espacio;
    echo $valore;
    var_dump($e);
    echo $espacio;
    echo $valorf;
    var_dump($f);
    ?>
    </body>
    </html>