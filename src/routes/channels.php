<?php

use \Vikekh\Lampjavel\Api\Models\Channel as Channel;
use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/channels', function () {

    // GET /channels

    // GET /channels/{channelId}

    // GET /channels/{channelId}/images

    $this->get('/{channelId}/images', function ($req, $res, $args = []) {
    //$app->get('', function ($channelId) use ($app) {
        $params = $req->getQueryParams();
        $channel = Channel::find($args['channelId']);
        $images = $channel->images()->page($params)->sort($params);

        //$res->status(200);
        echo $images->get()->toJson();
    });

    // POST /channels

    $this->post('/', function (Request $req,  Response $res, $args = []) {
        $params = $req->params();
        $channel = new Channel;
        $channel->fill($params);

        if (!$channel->save()) {
            $app->halt(400);
        }

        $res->status(201);
        echo $channel->toJson();
    });

    // PUT /channels/{channelId}

    // PUT /channels/{channelId}/images/{imageId}

    $this->put('/{channelId}/images/{imageId}', function (Request $req,  Response $res, $args = []) {
        $channel = Channel::find($args['channelId']);
        $image = Image::find($args['imageId']);

        if ($channel === null) {
            $app->halt(400, 'Channel "' . $args['channelId'] . '" does not exist.');
        } else if ($image === null) {
            $app->halt(400, 'Image "' . $args['imageId'] . '" does not exist.');
        }

        $channel->images()->attach($image->id);

        $app->response->status(200);
    });

    // DELETE /channels/{channelId}

});