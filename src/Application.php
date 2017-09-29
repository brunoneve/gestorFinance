<?php
declare(strict_types = 1);
namespace GestorFin;


use GestorFin\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;

class Application
{
    /**
     * @var ServiceContainerInterface
     */
    private $serviceContainer;

    /**
     * Application constructor.
     * @param ServiceContainerInterface $serviceContainer
     */
    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    /**
     * @param string $name
     * @param $service
     */
    public function addService(string $name, $service):void
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    /**
     * @param PluginInterface $plugin
     */
    public function plugin(PluginInterface $plugin):void
    {
        $plugin->register($this->serviceContainer);
    }

    /**
     * @param $path
     * @param $action
     * @param null $name
     * @return Application
     */
    public function get($path, $action, $name = null):Application
    {
        $routing = $this->service('routing');
        $routing->get($name, $path, $action);
        return $this;
    }

    public function start()
    {
        $route = $this->service('route');
        /** @var ServerRequestInterface $request */
        $request = $this->service(RequestInterface::class);

        if (!$route) {
           die('Page not found!');
        }

        foreach ($route->attributes as $key => $value) {
            $request = $request->withAttribute($key,$value);
        }

        $callable = $route->handler;
        $callable($request);
    }
}