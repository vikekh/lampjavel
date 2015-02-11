<?php

require '../vendor/autoload.php';
require '../app/config/database.php';

//use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\Slim;

$app->get('/', function () use ($app) {
    echo '/';
});

$app->error(function (\Exception $e) use ($app) {
    $app->status(400);
    echo json_encode($e->message);
});

require '../app/routes/channels.php';
require '../app/routes/images.php';

$app->run();