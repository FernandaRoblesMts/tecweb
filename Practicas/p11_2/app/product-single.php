<?php

use backend\Read\Read;

require_once __DIR__.'/backend/start.php';

$single = new Read('marketzone');
$single->single($_POST['id']);
echo $single->getResponse();
?>