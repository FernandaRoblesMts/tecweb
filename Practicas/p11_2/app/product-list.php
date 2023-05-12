<?php
    use backend\Read\Read;

    require_once __DIR__.'/backend/start.php';

    $leer = new Read('marketzone');
    $leer->list();
    echo $leer->getResponse();
?>