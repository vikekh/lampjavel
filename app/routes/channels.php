<?php

use Illuminate\Support\Facades\DB;

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
        /*if (!($channel = \Channel::find($channelName))) {
            $app->halt(400, 'Channel not found.');
        }*/

        $image = new \Image;

        if ($url = $app->request->post('url')) {
            $image->url = $url;
        }
        
        $image->created = null;
        $image->updated = null;

        //DB::transaction(function () use ($image) {
            $image->save();
            $image->channels()->attach($channelName); //sync(array($channel->name));
        //});

        $app->status(201);
        echo $image->toJson();
    });

    // read

    $app->get('/', function () use ($app) {
        $channels = \Channel::all();

        echo $channels->toJson();
    });

    $app->get('/:channelName/images', function ($channelName) use ($app) {
        if (!($channel = \Channel::find($channelName))) {
            $app->halt(400, 'Channel not found.');
        }

        $images = $channel->images;

        if ($orderBy = $app->request->get('orderby')) {
            switch ($orderBy) {
                case 'random':
                    $images = $images->orderByRaw('rand()');
                    break;
            }
        }

        if ($limit = $app->request->get('limit')) {
            $images = $images->take(intval($limit));
        }

        echo $images->toJson();
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