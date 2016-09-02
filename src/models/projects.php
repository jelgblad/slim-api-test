<?php

function getProjects($app, $args=[]){

    // Get args
    if(isset($args['project_id'])) $project_id = $args['project_id'];
    if(isset($args['embed'])) $embed = $args['embed'];

    // Authenticated user
    $auth_user_id = $app->auth;

    // $query = 'SELECT * FROM projects';
    $query = 'SELECT DISTINCT id, projects.user_id, name, description FROM projects';
    $query .= ' LEFT JOIN users_in_projects ON projects.id=users_in_projects.project_id';
    $query .= ' WHERE (users_in_projects.user_id="' . $auth_user_id . '"';
    $query .= ' OR projects.user_id="' . $auth_user_id . '")';
    if(isset($project_id)) {
        $query .= ' AND projects.id="' . $project_id . '" LIMIT 1';
    }
    $result = $app->db->query($query);

    while($row = $result->fetch_assoc()){

        // Embed
        if(isset($embed)) {
            if($embed === 'user'){

                $user = getUsers($app, [
                    'user_id' => $row['user_id']
                ]);

                $row['user'] = $user;
            }
        }

        $data[] = $row;
    }

    if(!isset($data) && isset($project_id)) return null;
    if(!isset($data)) $data = [];

    if(isset($project_id)) return $data[0];

    return $data;
}

function createProject($app, $name, $description){
    
    $auth_user_id = $app->auth;

    // Create values array
    $insert_values = '';
    $insert_values .= 'REPLACE(UUID(),"-","")';
    $insert_values .= ',"' . $auth_user_id . '"';
    $insert_values .= ',"' . $name . '"';
    $insert_values .= ',"' . $description . '"';

    // Build and execute query
    $query = 'INSERT INTO projects VALUES (' . $insert_values . ')';
    $result = $app->db->query($query);

    return $result;
}

function deleteProject($app, $project_id){
    
    $auth_user_id = $app->auth;

    $query = 'DELETE FROM projects WHERE id="' . $project_id . '"';
    $result = $app->db->query($query);

    return $result;
}