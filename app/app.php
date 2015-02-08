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

$app->post('/channels', function () use ($app) {
    $channel = new \Channel;

    if ($name = $app->request->post('name')) {
        $channel->name = $name;
    }

    if ($public = $app->request->post('public')) {
        $channel->public = boolval($public);
    }

    $channel->created = null;
    $channel->updated = null;
    $channel->save();

    echo $channel->toJson();
});

$app->post('/channels/:channelName/images', function ($channelName) use ($app) {
    $image = new \Image;

    if ($url = $app->request->post('url')) {
        $image->url = $url;
    }

    $image->created = null;
    $image->updated = null;
    $image->save();
    $image->channels()->sync(array($channelName));

    echo $image->toJson();
});

$app->get('/channels/:channelName/images(/:imageId)', function ($channelName, $imageId = null) use ($app) {
    $images = \Channel::find($channelName)->images(); //->where('image_i', '=', $channelName);

    if ($imageId != null) {
        $images = $images->find(intval($imageId));
    }

    if ($orderBy = $app->request->get('orderby')) {
        switch ($orderBy) {
            case 'random':
                $images = $images->orderByRaw('RAND()');
                break;
        }
    }

    if ($limit = $app->request->get('limit')) {
        if (is_numeric($limit)) {
            $images = $images->take(intval($limit));
        }
    }

    echo $images->get()->toJson();
});

$app->run();