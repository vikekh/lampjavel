<?php

require '../vendor/autoload.php';
require '../app/config.php';

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\Slim;

$app->get('/', function () use ($app) {
    echo '/';
});

require '../app/routes/channels.php';
require '../app/routes/images.php';

$app->run();