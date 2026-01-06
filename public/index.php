<?php
require __DIR__ . '/../bootstrap.php';

$app = new App\Core\App(require __DIR__ . '/../routes/web.php');
$app->run();
