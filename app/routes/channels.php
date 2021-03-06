<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$app->group('/channels', function () use ($app) {

    // create

    $app->post('/', function () use ($app) {
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

        $app->status(201);
        echo $channel->toJson();
    });

    $app->post('/:channelName/images', function ($channelName) use ($app) {
        if (!($channel = \Channel::find($channelName))) {
            $app->halt(400, 'Channel not found.');
        }

        $image = new \Image;

        if ($url = $app->request->post('url')) {
            $image->url = $url;
        }
        
        $image->created = null;
        $image->updated = null;

        Capsule::transaction(function () use ($image, $channel) {
            $image->save();
            $image->channels()->attach($channel->name);
        });

        $app->status(201);
        echo $image->toJson();
    });

    // read

    $app->get('/', function () use ($app) {
        $channels = \Channel::all();

        echo $channels->toJson();
    });

    $app->get('/:channelName/images', function ($channelName) use ($app) {
        $params = $app->request->params();

        if (!($channel = \Channel::find($channelName))) {
            throw new \Exception('Channel not found.');
        }

        $images = $channel->images();
        
        $images->sort($params['sort']);
        $images->skip(intval($params['offset']));
        $images->take(intval($params['limit']));

        echo $images->get()->toJson();
    });

    // update

    $app->put('/:channelName', function ($channelName) use ($app) {
        if (!($channel = \Channel::find($channelName))) {
            $app->halt(400, 'Channel not found.');
        }

        /*if ($name = $app->request->put('name')) {
            $channel->name = $name;
        }*/

        if ($public = $app->request->put('public')) {
            $channel->public = boolval($public);
        }

        $channel->save();

        echo $channel->toJson();
    });

    // delete

});