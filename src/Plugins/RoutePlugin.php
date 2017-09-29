<?php

namespace GestorFin\Plugins;


use Aura\Router\RouterContainer;
use GestorFin\ServiceContainerInterface;

class RoutePlugin implements PluginInterface
{

    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();
        /** @var $map - Register Routers of Application */
        $map = $routerContainer->getMap();
        /** @var $matcher - Identifies the requested route */
        $matcher = $routerContainer->getMatcher();
        /** @var $generator  - generate links based on registered routes */
        $generator = $routerContainer->getGenerator();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
    }
}