<?php

use \Vikekh\Lampjavel\Api\Models\Image as Image;

// GET /images

// GET /images/{imageId}
$app->get('/images/{imageId}', function ($request, $response, $args = []) {
    $image = Image::find($args['imageId']);

    if ($image === null) {
        throw new Exception('Could not find image.');
    }

    echo $image->toJson();
});

// POST /images
$app->post('/images', function ($request, $response, $args = []) {
    $params = $request->getParsedBody();
    $image = new Image($params);

    if (!$image->save()) {
        throw new Exception('Could not create image.');
    }

    echo $image->toJson();
});

// PUT /images/{imageId}

// DELETE /images/{imageId}