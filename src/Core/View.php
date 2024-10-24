<?php

namespace Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    protected $twig;

    public function __construct()
    {
        // Verifique se o caminho está correto
        $loader = new FilesystemLoader(__DIR__ . '/../../app/Views');
        $this->twig = new Environment($loader);
    }

    public function render($view, $data = [])
    {
        echo $this->twig->render($view . '.html.twig', $data);
    }
}
