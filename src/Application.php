<?php

namespace GestorFin;


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
    public function addService(string $name, $service)
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLaze($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }
}