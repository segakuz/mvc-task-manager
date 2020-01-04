<?php

require_once './core/Autoloader.php';
require_once './helpers/dump.php';

ini_set('display_errors', '1');
error_reporting(E_ALL);

$app = App::getApp();
$app->router->run();
// dump(get_defined_vars());
// dump($_SESSION);
// dump($app->getRequest()->getSession()->getSess());