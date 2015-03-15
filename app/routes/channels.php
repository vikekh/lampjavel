<?php

use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Vikekh\Lampjavel\Api\Models\Channel as Channel;
use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/channels', function () use ($app) {

    // GET /channels

    // GET /channels/{channelId}

    // GET /channels/{channelId}/images

    $app->get('/:channelId/images', function ($channelId) use ($app) {
        $params = $app->request->params();
        $channel = Channel::find($channelId);
        $images = $channel->images();

        $images->sort($params['sort']);
        $images->skip(intval($params['offset']));
        $images->take(intval($params['limit']));

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
        try {
            $channel = Channel::findOrFail($channelId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Channel id "' + $channelId + '" does not exist.');
        }

        try {
            $image = Image::findOrFail($imageId);
        } catch (ModelNotFoundException $e) {
            throw new \Exception('Image id "' + $imageId + '" does not exist.');
        }

        $channel->images()->attach($image->id);

        $app->response->status(200);
    });

    // DELETE /channels/{channelId}

});