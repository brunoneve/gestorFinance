<?php
declare(strict_types = 1);
namespace GestorFin\Plugins;


use Aura\Router\RouterContainer;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;
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
        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy('route', function (ContainerInterface $container) {
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
            return $matcher->match($request);
        });
    }

    /**
     * @return RequestInterface
     */
    protected function getRequest(): RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}