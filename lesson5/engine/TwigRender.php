<?php

namespace app\engine;

use app\interfaces\IRenderer;
use Twig\Environment;

class TwigRender implements IRenderer
{
    public $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function renderTemplate($template, $params=[])
    {
        return $this->twig->render($template.'.twig', $params);
    }

}