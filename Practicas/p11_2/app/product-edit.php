<?php
    use backend\Update\Update;
    require_once __DIR__.'/backend/start.php';

    $actualizar = new Update('marketzone');
    $actualizar->edit( json_decode( json_encode($_POST) ) );
    echo $actualizar->getResponse();
?>