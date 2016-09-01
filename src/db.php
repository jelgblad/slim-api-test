<?php

$app->add(function($request, $response, $next) use ($app){
    
    $host   = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db     = 'slim-api-test';

    $mysqli = new mysqli($host, $user, $pass, $db);
    $mysqli->set_charset('utf8');

    $app->db = $mysqli;

    return $next($request, $response);
});
