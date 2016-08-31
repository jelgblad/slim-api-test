<?php

$app->group('/users', function () use ($app) {

    $app->get('', function ($request, $response, $args) {

        $data[] = 'project user 1';
        $data[] = 'project user 2';
        $data[] = 'project user 3';

        return $response->withJson($data);
    });

    $app->get('/{user_id}', function ($request, $response, $args) {

        $data = 'project ' . $args['project_id'] . ', user ' . $args['user_id'];

        return $response->withJson($data);
    });
});