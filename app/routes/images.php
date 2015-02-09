<?php

$app->group('/images', function () use ($app) {

    // create

    // read

    $app->get('/:imageId', function ($imageId) use ($app) {
        $image = \Image::find(intval($imageId));

        echo $image->toJson();
    });

    // update

    // delete

});