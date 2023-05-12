<?php

use backend\Create\Create;
require_once __DIR__.'/backend/start.php';

    $Crear = new Create('marketzone');
    $Crear->add( json_decode( json_encode($_POST) ) );
    echo $Crear->getResponse();
?>