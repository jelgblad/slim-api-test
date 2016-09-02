<?php

// Users
$app->group('/users', function () use ($app) {

    // Single user
    $app->group('/{user_id}', function () use ($app) {

        require_once 'projects/projects.php';
        
        $app->get('', function ($request, $response, $args) use ($app) {

            $user_id = $args['user_id'];

            $data = getUsers($app, [
                'user_id' => $user_id
            ]);

            if(!isset($data)) return $response->withJson('NOT_FOUND', 404);

            return $response->withJson($data);
        });
    });

    $app->get('', function ($request, $response, $args) use ($app)  {   

        $data = getUsers($app);

        return $response->withJson($data);
    });

    $app->post('', function ($request, $response, $args) use ($app)  {

        // Parse body
        $body = $request->getParsedBody();

        // Get fields
        if(isset($body['firstname'])) $firstname = $body['firstname'];
        if(isset($body['lastname'])) $lastname = $body['lastname'];

        // Check required fields
        if(!isset($firstname)) return $response->withJson('BAD_REQUEST', 400);
        if(!isset($lastname)) return $response->withJson('BAD_REQUEST', 400);

        require_once '../src/dbconnect.php';

        // // Create fields array
        // $insert_fields = '';
        // $insert_fields .= 'id';
        // if(isset($firstname)) $insert_fields .= ',firstname';
        // if(isset($lastname)) $insert_fields .= ',lastname';

        // Create values array
        $insert_values = '';
        $insert_values .= 'REPLACE(UUID(),"-","")';
        $insert_values .= ',"' . $firstname . '"';
        $insert_values .= ',"' . $lastname . '"';

        // Build and execute query
        $query = 'INSERT INTO users VALUES (' . $insert_values . ')';
        $result = $mysqli->query($query);

        // Check result
        if(!$result) return $response->withJson('BAD_REQUEST', 400);

        // Return created
        return $response->withJson('USER_CREATED', 201);
    });
});