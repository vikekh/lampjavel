<?php

$app->group('/images', function () use ($app) {

    // create

    $app->post('/', function () use ($app) {
        $image = new \Image;
        $image->url = $app->request->post('url');
        $image->created = null;
        $image->updated = null;

        if (!$image->save()) {
            $app->halt(400);
        }

        $app->response->status(201);
        echo $image->toJson();
    });

    // read

    $app->get('/:id', function ($id) use ($app) {
        $image = \Image::find(intval($id));

        echo $image->toJson();
    });

    // update

    // delete

});