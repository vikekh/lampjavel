<?php

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

        echo $channel->toJson();
    });

    $app->post('/:channelName/images', function ($channelName) use ($app) {
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

    // read

    $app->get('/:channelName/images', function ($channelName) use ($app) {
        $images = \Channel::find($channelName)->images();

        if ($orderBy = $app->request->get('orderby')) {
            switch ($orderBy) {
                case 'random':
                    $images = $images->orderByRaw('rand()');
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

    // update

    // delete

});