<?php
require __DIR__ . '/../bootstrap.php';

use App\Core\App;

$routes = require __DIR__ . '/../routes/web.php';
$app = new App($routes);

echo "Smoke test loaded. Routes: " . count($routes['GET']) . " GET, " . count($routes['POST']) . " POST" . PHP_EOL;
