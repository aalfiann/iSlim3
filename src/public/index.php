<?php

//Load all class libraries
require '../vendor/autoload.php';

$classes = glob('../classes/*.php');
foreach ($classes as $class) {
    require $class;
}

//Create config
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "root";
$config['db']['dbname'] = "javelinee";

//Read config
$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$models = glob('../models/*.php');
foreach ($models as $model) {
    require $model;
}

//load templates
$container['viewbackend'] = new \Slim\Views\PhpRenderer("../templates/default/backend");
$container['viewfrontend'] = new \Slim\Views\PhpRenderer("../templates/default/frontend");

//Run Monolog
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

//Build database connection container
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Automatically load router files
$routers = glob('../routers/*.router.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();

?>