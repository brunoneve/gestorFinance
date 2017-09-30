<?php
declare(strict_types = 1);
namespace GestorFin\Plugins;


use Interop\Container\ContainerInterface;
use GestorFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;


class DbPlugin implements PluginInterface
{

    /**
     * @param ServiceContainerInterface $container
     */
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/database.php';
        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();
    }

}