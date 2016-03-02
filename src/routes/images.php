<?php

use \Vikekh\Lampjavel\Api\Models\Image as Image;

$app->group('/images', function () {

    // GET /images

    // GET /images/{imageId}

    $this->get('/{imageId}', function (Request $req,  Response $res, $args = []) {
        $image = Image::find($args['imageId']);

        if ($image === null) {
            $app->halt(400, 'Image "' . $args['imageId'] . '" does not exist.');
        }

        echo $image->toJson();
    });

    // POST /images

    $this->post('/', function (Request $req,  Response $res, $args = []) {
        $params = $req->params();
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