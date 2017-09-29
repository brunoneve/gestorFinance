<?php

use GestorFin\Application;
use GestorFin\Plugins\RoutePlugin;
use GestorFin\ServiceContainer;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());

$app->get('/', function(){
    echo 'First route';
});

$app->get('/home/{name}/{id}', function(ServerRequestInterface $request){
    echo "Mostrando a home!!";
    echo "<br>";
    echo $request->getAttribute("name");
    echo "<br>";
    echo $request->getAttribute("id");
    echo "<br>";
});


$app->start();