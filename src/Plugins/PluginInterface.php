<?php

namespace GestorFin\Plugins;


use GestorFin\ServiceContainerInterface;

interface PluginInterface
{
    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container);
}