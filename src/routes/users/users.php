<?php

$app->group('/users', function () use ($app) {

    $app->group('/{user_id}', function () use ($app) {
        
        $app->get('', function ($request, $response, $args) {

            $user_id = $args['user_id'];

            require_once '../src/dbconnect.php';

            $query = 'SELECT * FROM users WHERE id="' . $user_id . '" LIMIT 1';
            $result = $mysqli->query($query);

            $data = $result->fetch_assoc();

            if(!$data) return $response->withJson('NOT_FOUND', 404);

            return $response->withJson($data);
        });
    });

    $app->get('', function ($request, $response, $args) {   

        require_once '../src/dbconnect.php';

        $query = 'SELECT * FROM users';
        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        if(!$data) $data = [];

        return $response->withJson($data);
    });
});