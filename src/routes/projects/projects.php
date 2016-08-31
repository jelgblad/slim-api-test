<?php

$app->group('/projects', function () use ($app) {

    $app->group('/{project_id}', function () use ($app) {

        require_once 'users/users.php';
        
        $app->get('', function ($request, $response, $args) {

            $data = 'project ' . $args['project_id'];

            return $response->withJson($data);
        });
    });

    $app->get('', function ($request, $response, $args) {

        $data[] = 'project 1';
        $data[] = 'project 2';
        $data[] = 'project 3';

        return $response->withJson($data);
    });
});