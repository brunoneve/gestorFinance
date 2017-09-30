<?php
declare(strict_types = 1);
namespace GestorFin\View;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class ViewRender implements ViewRenderInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twigEnviroment;

    /**
     * ViewRender constructor.
     * @param \Twig_Environment $twigEnviroment
     */
    public function __construct(\Twig_Environment $twigEnviroment)
    {
        $this->twigEnviroment = $twigEnviroment;
    }

    /**
     * @param string $template
     * @param array $context
     * @return ResponseInterface
     */
    public function render(string $template, array $context = []): ResponseInterface
    {
        $result = $this->twigEnviroment->render($template, $context);
        $response = new Response();
        $response->getBody()->write($result);

        return $response;
    }
}