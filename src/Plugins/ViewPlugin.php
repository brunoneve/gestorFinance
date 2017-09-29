<?php
declare(strict_types = 1);
namespace GestorFin\Plugins;


use Interop\Container\ContainerInterface;
use GestorFin\ServiceContainerInterface;

class ViewPlugin implements PluginInterface
{

    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function (ContainerInterface $container) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
            $twig = new \Twig_Environment($loader);
            return $twig;
        });
    }

}