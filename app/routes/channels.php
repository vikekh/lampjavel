<?php

use \Vikekh\Lampjavel\Api\Models\Channel as Channel;
use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/channels', function () use ($app) {

    // GET /channels

    // GET /channels/{channelId}

    // GET /channels/{channelId}/images

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

    // DELETE /channels/{channelId}

});