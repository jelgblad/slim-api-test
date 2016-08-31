<?php

$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'slim-api-test';

$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli->set_charset('utf8');