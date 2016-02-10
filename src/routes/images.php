<?php

use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/images', function () use ($app) {

    // GET /images

    // GET /images/{imageId}

    $app->get('/:id', function ($imageId) use ($app) {
        $image = Image::find($imageId);

        if ($image === null) {
            $app->halt(400, 'Image "' . $imageId . '" does not exist.');
        }

        echo $image->toJson();
    });

    // POST /images

    $app->post('/', function () use ($app) {
        $params = $app->request->params();
        $image = new Image($params);

        if (!$image->save()) {
            $app->halt(400);
        }

        $app->response->status(201);
        echo $image->toJson();
    });

    // PUT /images/{imageId}

    // DELETE /images/{imageId}

});