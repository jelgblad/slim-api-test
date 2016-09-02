<?php

function getUsers($app, $args=[]){

    // Get args
    if(isset($args['user_id'])) $user_id = $args['user_id'];
    if(isset($args['project_id'])) $project_id = $args['project_id'];

    // Authenticated user
    $auth_user_id = $app->auth;

    // $query = 'SELECT * FROM projects';
    $query = 'SELECT id, firstname, lastname FROM users';
    // $query .= ' LEFT JOIN users_in_projects ON projects.id=users_in_projects.project_id';
    // $query .= ' WHERE (users_in_projects.user_id="' . $auth_user_id . '"';
    // $query .= ' OR projects.user_id="' . $auth_user_id . '")';
    if(isset($user_id)) {
        $query .= ' WHERE id="' . $user_id . '" LIMIT 1';
    }
    else if(isset($project_id)) {
        $query .= ' LEFT JOIN users_in_projects ON users.id=users_in_projects.user_id';
        $query .= ' WHERE project_id="' . $project_id . '"';
    }
    $result = $app->db->query($query);

    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    if(!isset($data) && isset($user_id)) return null;
    if(!isset($data)) $data = [];

    /// TODO: embed fields

    if(isset($user_id)) return $data[0];

    return $data;
}

// function createProject($app, $name, $description){
    
//     $auth_user_id = $app->auth;

//     // Create values array
//     $insert_values = '';
//     $insert_values .= 'REPLACE(UUID(),"-","")';
//     $insert_values .= ',"' . $auth_user_id . '"';
//     $insert_values .= ',"' . $name . '"';
//     $insert_values .= ',"' . $description . '"';

//     // Build and execute query
//     $query = 'INSERT INTO projects VALUES (' . $insert_values . ')';
//     $result = $app->db->query($query);

//     return $result;
// }