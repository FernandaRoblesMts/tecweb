<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"&gt;
<html>
<head>
    <title>Práctica 6</title>
</head>
<body>
    <p>Practica 6</p>
    <?php
    $a = '0';
    $b = 'TRUE';
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);
    $g = 'a = ';
    $valorb = 'b = ';
    $valorc = 'c = ';
    $valord = 'd = ';
    $valore = 'e = ';
    $valorf = 'f = ';
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