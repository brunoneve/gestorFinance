<?php

use GestorFin\Application;
use GestorFin\Models\CategoryCost;
use GestorFin\Plugins\RoutePlugin;
use GestorFin\Plugins\ViewPlugin;
use GestorFin\ServiceContainer;
use GestorFin\Plugins\DbPlugin;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());


$app
    ->get('/category-costs', function() use ($app) {
        $meuModel = new CategoryCost();
        $categories = $meuModel->all();
        $view = $app->service('view.renderer');
        return $view->render('category-costs/list.html.twig',[
            'categories' => $categories
        ]);
    }, 'category-costs.list')
    ->get('/category-costs/new', function() use ($app) {
        $view = $app->service('view.renderer');
        return $view->render('category-costs/new.html.twig');
    }, 'category-costs.new')
    ->post('/category-costs/store', function (ServerRequestInterface $request) use ($app) {
        $data = $request->getParsedBody();
        CategoryCost::create($data);
        return $app->redirect('/category-costs');
    }, 'category-costs.store');

$app->get('/{name}', function(ServerRequestInterface $request) use($app){
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});


$app->start();