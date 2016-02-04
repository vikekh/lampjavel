<?php

use \Vikekh\Lampjavel\Api\Models\Channel as Channel;
use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/channels', function () use ($app) {

    // GET /channels

    // GET /channels/{channelId}

    // GET /channels/{channelId}/images

    $app->get('/:channelId/images', function ($channelId) use ($app) {
        $params = $app->request->params();
        $channel = Channel::find($channelId);
        $images = $channel->images()->page($params)->sort($params);

        $app->response->status(200);
        echo $images->get()->toJson();
    });

    // POST /channels

    $app->post('/', function () use ($app) {
        $channel = new Channel;
        $channel->fill($app->request->params());

        if (!$channel->save()) {
            $app->halt(400);
        }

        $app->response->status(201);
        echo $channel->toJson();
    });

    // PUT /channels/{channelId}

    // PUT /channels/{channelId}/images/{imageId}

    $app->put('/:channelId/images/:imageId', function ($channelId, $imageId) use ($app) {
        $channel = Channel::find($channelId);
        $image = Image::find($imageId);

        if ($channel === null) {
            $app->halt(400, 'Channel "' . $channelId . '" does not exist.');
        } else if ($image === null) {
            $app->halt(400, 'Image "' . $imageId . '" does not exist.');
        }

        $channel->images()->attach($image->id);

        $app->response->status(200);
    });

    // DELETE /channels/{channelId}

});