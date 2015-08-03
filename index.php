<?php
require 'vendor/autoload.php';
define('APP_PATH', dirname(__DIR__));

session_cache_limiter(false);
session_start();


$app = new \Slim\Slim();

use RedBeanPHP\R as R;

R::setup('mysql:host=localhost;dbname=naughtyfire', 'root', 'nitoryolai');

$app = New \SlimController\Slim(array(
    'controller.class_prefix'    => '\\Naughtyfire\\Controller',
    'controller.method_suffix'   => 'Action',
    'controller.template_suffix' => 'php'
));

$app->addRoutes(array(
    '/' => 'Home:index',
    '/holiday/create' => 'Home:createHoliday',
    '/settings' => 'Home:settings',
    '/settings/update' => 'Home:updateSettings'
));

$view = $app->view();
$view->setTemplatesDirectory('./templates');

$app->run();