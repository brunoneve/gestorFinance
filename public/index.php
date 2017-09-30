<?php

use GestorFin\Application;
use GestorFin\Plugins\RoutePlugin;
use GestorFin\Plugins\ViewPlugin;
use GestorFin\ServiceContainer;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/', function(){
    echo 'First route';
});

$app->get('/{name}', function(ServerRequestInterface $request) use($app){
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});


$app->start();