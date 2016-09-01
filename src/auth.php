<?php

$app->add(function($request, $response, $next) use ($app){
    
    /// TODO: authenticate

    // $app->auth = '92c62483707a11e696f55c260a4bf91a';
    $app->auth = '962c63e5707a11e696f55c260a4bf91a';

    return $next($request, $response);
});