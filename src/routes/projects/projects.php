<?php

$app->group('/projects', function () use ($app) {

    $app->group('/{project_id}', function () use ($app) {

        require_once 'users/users.php';
        
        $app->get('', function ($request, $response, $args) {

            $project_id = $args['project_id'];

            require_once '../src/dbconnect.php';

            $query = 'SELECT * FROM projects WHERE id="' . $project_id . '" LIMIT 1';
            $result = $mysqli->query($query);

            $data = $result->fetch_assoc();

            if(!$data) return $response->withJson('NOT_FOUND', 404);

            return $response->withJson($data);
        });

        $app->delete('', function ($request, $response, $args) {

            $project_id = $args['project_id'];

            require_once '../src/dbconnect.php';

            $query = 'DELETE FROM projects WHERE id="' . $project_id . '"';
            $result = $mysqli->query($query);

            // Check result
            if(!$result) return $response->withJson('BAD_REQUEST', 400);

            // Return deleted
            return $response->withJson('DELETED', 200);
        });
    });

    $app->get('', function ($request, $response, $args) {   

        require_once '../src/dbconnect.php';

        $query = 'SELECT * FROM projects';
        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        if(!$data) $data = [];

        return $response->withJson($data);
    });

    $app->post('', function ($request, $response, $args) {

        // Parse body
        $body = $request->getParsedBody();

        // Get fields
        if(isset($body['name'])) $name = $body['name'];
        if(isset($body['description'])) $description = $body['description'];

        // Check required fields
        if(!isset($name)) return $response->withJson('BAD_REQUEST', 400);

        require_once '../src/dbconnect.php';

        // Create fields array
        $insert_fields = '';
        $insert_fields .= 'id';
        if(isset($name)) $insert_fields .= ',name';
        if(isset($description)) $insert_fields .= ',description';

        // Create values array
        $insert_values = '';
        $insert_values .= 'REPLACE(UUID(),"-","")';
        if(isset($name)) $insert_values .= ',"' . $name . '"';
        if(isset($description)) $insert_values .= ',"' . $description . '"';

        // Build and execute query
        $query = 'INSERT INTO projects (' . $insert_fields . ') VALUES (' . $insert_values . ')';
        $result = $mysqli->query($query);

        // Check result
        if(!$result) return $response->withJson('BAD_REQUEST', 400);

        // Return created
        return $response->withJson('CREATED', 201);
    });
});