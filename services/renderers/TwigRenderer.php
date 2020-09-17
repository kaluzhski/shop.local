<?php

namespace App\services\renderers;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigRenderer
{
    protected $twig;

    public function __construct()
    {
      $loader = new FilesystemLoader([
        dirname(__DIR__, 2) . '/views/',
        dirname(__DIR__, 2) . '/views/layouts/'
      ]);

      $this->twig = new Environment($loader, ['debug' => true]);
      $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function render ($template, $params = [])
    {
      $template .='.twig';
      return $this->twig->render($template, $params);
    }
}
