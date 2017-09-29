<?php
declare(strict_types = 1);
namespace GestorFin;

interface ServiceContainerInterface
{
    public function add(string $name, $service);

    public function addLaze(string $name, callable $callable);

    public function get(string $name);

    public function has(string $name);

}