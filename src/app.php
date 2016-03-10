<?php

error_reporting(E_ALL);

require '../vendor/autoload.php';
require '../src/config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection($config['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\App([
    'debug' => false,
    'mode' => 'development',
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);

$app->get('/', function (Request $req,  Response $res, $args = []) {
    echo '/';
});

require '../src/routes/channels.php';
require '../src/routes/images.php';

/*$app->error(function (\Exception $e) use ($app) {
    $app->status(400);
    echo json_encode(array(
        'code'    => 400,
        'message' => $e->getMessage()
    ));
});*/

$app->run();