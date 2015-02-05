<?php

require '../vendor/autoload.php';
require '../app/config.php';

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
	echo '/';
});

$app->get('/latest', function () use ($app) {
    $images = \Image::all();
    echo $images->toJson();
});

$app->get('/channels/:name', function ($name) use ($app) {
    $images = \Image::where('channel_name', '=', $name)->get();
    echo $images->toJson();
});

$app->get('/channels/:name/random', function ($name) use ($app) {
    $image = \Image::where('channel_name', '=', $name)->orderByRaw('RAND()')->first();
    echo $image->toJson();
});

$app->run();