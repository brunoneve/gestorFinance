<?php
declare(strict_types = 1);
namespace GestorFin\Plugins;


use GestorFin\View\ViewRender;
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

            $generator = $container->get('routing.generator');
            $twig->addFunction(new \Twig_SimpleFunction('route',
                function (string $name, array $params = []) use($generator){
                    return $generator->generate($name, $params);
                }));
            return $twig;
        });

        $container->addLazy('view.renderer', function (ContainerInterface $container) {
            $twigEnviroment = $container->get('twig');
            return new ViewRender($twigEnviroment);
        });
    }

}