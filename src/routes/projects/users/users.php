<?php

$app->group('/users', function () use ($app) {

    $app->group('/{user_id}', function () use ($app) {
        
        // $app->get('', function ($request, $response, $args) {

        //     $project_id = $args['project_id'];
        //     $user_id = $args['user_id'];

        //     require_once '../src/dbconnect.php';

        //     $query = 'SELECT id AS user_id FROM users INNER JOIN users_in_projects ON users.id=users_in_projects.user_id WHERE project_id="' . $project_id . '" AND user_id="' . $user_id . '" LIMIT 1';
        //     $result = $mysqli->query($query);

        //     $data = $result->fetch_assoc();

        //     if(!isset($data)) return $response->withJson('NOT_FOUND', 404);

        //     return $response->withJson($data);
        // });
    });

    $app->get('', function ($request, $response, $args) use ($app) {   

        $project_id = $args['project_id'];

        $data = getUsers($app, [
            'project_id' => $project_id
        ]);

        // require_once '../src/dbconnect.php';

        // $query = 'SELECT id AS user_id FROM users LEFT JOIN users_in_projects ON users.id=users_in_projects.user_id WHERE project_id="' . $project_id . '"';
        // $result = $mysqli->query($query);

        // while($row = $result->fetch_assoc()){
        //     $data[] = $row;
        // }

        if(!isset($data)) $data = [];

        return $response->withJson($data);
    });

    $app->post('', function ($request, $response, $args) use ($app) {

        $project_id = $args['project_id'];

        // Parse body
        $body = $request->getParsedBody();

        // Get fields
        // if(isset($body['project_id'])) $project_id = $body['project_id'];
        if(isset($body['user_id'])) $user_id = $body['user_id'];

        // Check required fields
        // if(!isset($project_id)) return $response->withJson('BAD_REQUEST', 400);
        if(!isset($user_id)) return $response->withJson('BAD_REQUEST', 400);

        require_once '../src/dbconnect.php';

        // Check if resouce exits
        $query = 'SELECT * FROM users_in_projects WHERE project_id="' . $project_id . '" AND user_id="' . $user_id . '"';
        if($mysqli->query($query)->num_rows > 0) return $response->withJson('PROJECT_USER_EXISTS', 409);

        // Create values array
        $insert_values = '';
        $insert_values .= '"' . $user_id . '"';
        $insert_values .= ',"' . $project_id . '"';

        // Build and execute query
        $query = 'INSERT INTO users_in_projects VALUES (' . $insert_values . ')';
        $result = $mysqli->query($query);

        // Check result
        if(!$result) return $response->withJson('COULD_NOT_INSERT', 500);

        // Return created
        return $response->withJson('USER_ADDED_TO_PROJECT', 201);
    });
});