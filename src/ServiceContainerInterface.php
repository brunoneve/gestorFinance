<?php
declare(strict_types = 1);
namespace GestorFin;

interface ServiceContainerInterface
{
    /**
     * @param string $name
     * @param $service
     */
    public function add(string $name, $service);

    /**
     * @param string $name
     * @param callable $callable
     */
    public function addLaze(string $name, callable $callable);

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * @param string $name
     * @return mixed
     */
    public function has(string $name);

}