<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"&gt;
<html>
<head>
    <title>Práctica 2</title>
</head>
<body>
    <h2>Inciso 6</h2>
    <?php
    
    
    $a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);
    
    echo "Valor de \$a: " . var_export((bool)$a, true) . PHP_EOL;
    echo "<br>Valor de \$b: " . var_export((bool)$b, true) . PHP_EOL;
    echo "<br>Valor de \$c: " . var_export($c, true) . PHP_EOL;
    echo "<br>Valor de \$d: " . var_export($d, true) . PHP_EOL;
    echo "<br>Valor de \$e: " . var_export($e, true) . PHP_EOL;
    echo "<br>Valor de \$f: " . var_export($f, true) . PHP_EOL;



    
    ?>
</body>
</html>