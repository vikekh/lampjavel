<?php

require '../vendor/autoload.php';
require '../api/config.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
    echo '?';
});

$app->get('/images', function () use ($app) {
    $images = \Image::all();
    echo $images->toJson();
});

$app->get('/images/:channelName', function ($channelName) use ($app) {
    $images = \Image::where('channel_name', '=', $channelName)->get();
    echo $images->toJson();
});

$app->run();