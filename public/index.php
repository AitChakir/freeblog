<?php

chdir(dirname(__DIR__));

require_once __DIR__.'/../core/requireFiles.php';

$data = require 'config/database.php';

$configRouters = require 'config/configRouters.php';

$pdoConn =  App\DB\DbFactory::create($data);
$conn= $pdoConn->getConn();
$controller = new App\Controllers\PostsController($conn);

$routerObj  = new Rotte($conn);
$routerObj->loadRouters($configRouters['ruoters']);


try {
$controller = $routerObj->dispatch();
$controller->display();


} catch(Exception $e) {
    echo $e->getMessage();
}

