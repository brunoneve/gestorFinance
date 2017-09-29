<?php
declare(strict_types = 1);
namespace GestorFin;

use Xtreamwayz\Pimple\Container;

class ServiceContainer implements ServiceContainerInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * ServiceContainer constructor.
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @param string $name
     * @param $service
     */
    public function add(string $name, $service):void
    {
        $this->container[$name] = $service;
    }

    /**
     * @param string $name
     * @param callable $callable
     */
    public function addLazy(string $name, callable $callable):void
    {
        $this->container[$name] = $this->container->factory($callable);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->container->get($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name)
    {
        return $this->container->has($name);
    }
}