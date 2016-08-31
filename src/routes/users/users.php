<?php

$app->group('/users', function () use ($app) {

    $app->get('', function ($request, $response, $args) {

        $data[] = 'user 1';
        $data[] = 'user 2';
        $data[] = 'user 3';

        return $response->withJson($data);
    });

    $app->get('/{user_id}', function ($request, $response, $args) {

        $data = 'user ' . $args['user_id'];

        return $response->withJson($data);
    });
});