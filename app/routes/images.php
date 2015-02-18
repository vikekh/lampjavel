<?php

$app->group('/images', function () use ($app) {

    // create

    $app->post('/', function () use ($app) {
        $image = new \Image;

        if ($url = $app->request->post('url')) {
            $image->url = $url;
        }
        
        $image->created = null;
        $image->updated = null;

        if (!$image->validate()) {
            $app->halt(400);
        }

        $image->save();
        //$image->channels()->sync(array($app->request->post('channelName')));

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