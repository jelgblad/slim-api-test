<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// require_once '../src/dbconnect.php';
require_once '../src/db.php';
require_once '../src/data.php';
require_once '../src/auth.php';
require_once '../src/routing.php';

$app->run();