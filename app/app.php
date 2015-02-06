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

$app->group('/images', function () use ($app) {

    $app->post('/:channelName', function ($channelName) use ($app) {
        $image = new \Image;

        if ($url = $app->request->post('url')) {
            $image->url = $url;
        }

        $image->channel_name = $channelName;
        $image->created = null;
        $image->updated = null;
        $image->save();

        echo $image->toJson();
    });

    $app->get('/:channelName', function ($channelName) use ($app) {
        $images = \Image::where('channel_name', '=', $channelName);

        if ($app->request->get('orderby')) {
            $orderBy = $app->request->get('orderby');

            switch ($orderBy) {
                case 'random':
                    $images = $images->orderByRaw('RAND()');
            }
        }

        if ($app->request->get('limit')) {
            $limit = $app->request->get('limit');

            if (is_numeric($limit)) {
                $images = $images->take(intval($limit));
            }
        }

        echo $images->get()->toJson();
    });

});

$app->run();