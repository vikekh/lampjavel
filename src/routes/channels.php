<?php

use \Vikekh\Lampjavel\Api\Models\Channel as Channel;
use \Vikekh\Lampjavel\Api\Models\Image as Image;

// GET /channels

// GET /channels/{channelId}

// GET /channels/{channelId}/images
$app->get('/channels/{channelId}/images', function ($request, $response, $args = []) {
    $params = $request->getQueryParams();
    $channel = Channel::find($args['channelId']);
    $images = $channel->images()->page($params)->sort($params);

    echo $images->get()->toJson();
});

// GET /channels/{channelId}/nextImage
$app->get('/channels/{channelId}/nextImage', function ($request, $response, $args = []) {
    $channel = Channel::find($args['channelId']);
    $images = $channel->images();

    echo $images->orderByRaw('rand()')->first()->toJson();
});

// POST /channels
$app->post('/channels', function ($request, $response, $args = []) {
    $params = $request->getParsedBody();
    $channel = new Channel;
    $channel->fill($params);

    if (!$channel->save()) {
        throw new Exception('Could not create channel.');
    }

    echo $channel->toJson();
});

// PUT /channels/{channelId}

// PUT /channels/{channelId}/images/{imageId}
$app->put('/channels/{channelId}/images/{imageId}', function ($request, $response, $args = []) {
    $channel = Channel::find($args['channelId']);
    $image = Image::find($args['imageId']);

    if ($channel === null) {
        throw new Exception('Could not find channel.');
    } else if ($image === null) {
        throw new Exception('Could not find image.');
    }

    $channel->images()->attach($image->id);
});

// DELETE /channels/{channelId}