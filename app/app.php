<?php

require '../vendor/autoload.php';
require '../app/config.php';

use Eloquence\Database\Traits\CamelCaseModel;

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\Slim;

$app->get('/', function () use ($app) {
    echo '/';
});

$app->group('/channels', function () use ($app) {

    $app->post('/', function () use ($app) {
        $channel = new \Channel;

        if ($name = $app->request->post('name')) {
            $channel->name = $name;
        }

        if ($admin = $app->request->post('admin')) {
            $channel->admin = $admin;
        }

        if ($public = $app->request->post('public')) {
            $channel->public = boolval($public);
        }

        $channel->created = null;
        $channel->updated = null;
        $channel->save();

        echo $channel->toJson();
    });

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

    $app->get('/:channelName(/:id)', function ($channelName, $id = null) use ($app) {
        $images = \Image::where('channel_name', '=', $channelName);

        if ($id != null) {
            $images = $images->find(intval($id));
        }

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

    $app->put('/:channelName/:id', function ($channelName, $id) use ($app) {
        $image = \Image::find(intval($id));

        if ($url = $app->request->params('url')) {
            $image->url = $url;
        }

        $image->save();

        echo $image->toJson();
    });

    $app->delete('/:channelName/:id', function ($channelName, $id) {
        $image = \Image::find(intval($id));
        $image->delete();
    });

});

$app->run();