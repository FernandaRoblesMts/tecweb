<?php
    use backend\Delete\Delete;
    require_once __DIR__.'/backend/start.php';

    $eliminar = new Delete('marketzone');
    $eliminar->delete( $_POST['id'] );
    echo $eliminar->getResponse();
?>