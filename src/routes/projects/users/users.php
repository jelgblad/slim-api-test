<?php

$app->group('/users', function () use ($app) {

    $app->group('/{user_id}', function () use ($app) {
        
        $app->get('', function ($request, $response, $args) {

            $project_id = $args['project_id'];
            $user_id = $args['user_id'];

            require_once '../src/dbconnect.php';

            $query = 'SELECT id,firstname,lastname FROM users INNER JOIN users_in_projects WHERE project_id="' . $project_id . '" AND user_id="' . $user_id . '" LIMIT 1';
            $result = $mysqli->query($query);

            $data = $result->fetch_assoc();

            if(!$data) return $response->withJson('NOT_FOUND', 404);

            return $response->withJson($data);
        });
    });

    $app->get('', function ($request, $response, $args) {   

        $project_id = $args['project_id'];

        require_once '../src/dbconnect.php';

        $query = 'SELECT id,firstname,lastname FROM users INNER JOIN users_in_projects WHERE project_id="' . $project_id . '"';
        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        if(!$data) $data = [];

        return $response->withJson($data);
    });
});