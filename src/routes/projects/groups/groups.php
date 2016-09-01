<?php

$app->group('/groups', function () use ($app) {

    $app->group('/{group_id}', function () use ($app) {
        
        $app->get('', function ($request, $response, $args) {

            $project_id = $args['project_id'];
            $group_id = $args['group_id'];

            require_once '../src/dbconnect.php';

            $query = 'SELECT id,name,description FROM groups WHERE project_id="' . $project_id . '" AND id="' . $group_id . '" LIMIT 1';
            $result = $mysqli->query($query);

            $data = $result->fetch_assoc();

            if(!isset($data)) return $response->withJson('NOT_FOUND', 404);

            return $response->withJson($data);
        });
    });

    $app->get('', function ($request, $response, $args) {   

        $project_id = $args['project_id'];

        require_once '../src/dbconnect.php';

        $query = 'SELECT id,name,description FROM groups WHERE project_id="' . $project_id . '"';
        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        if(!isset($data)) $data = [];

        return $response->withJson($data);
    });

    $app->post('', function ($request, $response, $args) {

        $project_id = $args['project_id'];

        // Parse body
        $body = $request->getParsedBody();

        // Get fields
        // if(isset($body['project_id'])) $project_id = $body['project_id'];
        if(isset($body['name'])) $name = $body['name'];
        if(isset($body['description'])) $description = $body['description'];

        // Check required fields
        // if(!isset($project_id)) return $response->withJson('BAD_REQUEST', 400);
        if(!isset($name)) return $response->withJson('BAD_REQUEST', 400);
        if(!isset($description)) $description = '';

        require_once '../src/dbconnect.php';

        // Check if resouce exits
        $query = 'SELECT * FROM groups WHERE project_id="' . $project_id . '" AND name="' . $name . '"';
        if($mysqli->query($query)->num_rows > 0) return $response->withJson('GROUP_EXISTS', 409);

        // Create values array
        $insert_values = '';
        $insert_values .= 'REPLACE(UUID(),"-","")';
        $insert_values .= ',"' . $project_id . '"';
        $insert_values .= ',"' . $name . '"';
        $insert_values .= ',"' . $description . '"';

        // Build and execute query
        $query = 'INSERT INTO groups VALUES (' . $insert_values . ')';
        $result = $mysqli->query($query);

        // Check result
        if(!$result) return $response->withJson('COULD_NOT_INSERT', 500);

        // Return created
        return $response->withJson('GROUP_CREATED', 201);
    });
});