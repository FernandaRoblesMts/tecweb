<?php
    use backend\Read\Read;
    require_once __DIR__.'/backend/start.php';

    $buscar = new Read('marketzone');
    $buscar->search( $_GET['search'] );
    echo $buscar->getResponse();
?>