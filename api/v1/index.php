<?php

require_once '../libs/Slim/Slim.php';
require_once 'dbHelper.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();

header('Access-Control-Allow-Origin: *');

$app->get('/comments', function() use($app, $db){
    $start = $app->request->get('start');
    $end = $app->request->get('end');

    $goods = $db->search('comments', '*', array(), $start, $end);

    echoResponse(200, $goods['rows']);
});

function echoResponse($status_code, $response){
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response, JSON_NUMERIC_CHECK);
}

$app->run();