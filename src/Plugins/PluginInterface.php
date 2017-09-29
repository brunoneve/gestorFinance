<?php

namespace GestorFin\Plugins;


use GestorFin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}