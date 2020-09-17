<?php

namespace App\core;

use App\services\Autoloader;
use App\services\DB;
use App\services\renderers\TwigRenderer;
use App\core\Container;
use App\services\Request;


/**
 * @property Request request
 */

class App
{


  protected $config;
  protected $container;


  public function getContainer()
  {
    if(empty($this->container)) {
      $this->container = new Container($this->getConfig('components'));
    }

    return $this->container;
  }

  public function getRepository($repositoryName)
  {
    return $this->app->db->getRepository($repositoryName);
  }

  public function run ($config)
  {
    $this->config = $config;
    $this->runController();

  }

  public function __get($name) {
     return $this->getContainer()->$name;
  }


  protected function runController()
  {

    $request = $this->request;
    $controllerName = $request->getController();
    $actionName = $request->getAction();

    $controllerClass = "\\App\\controllers\\" . ucfirst($controllerName) . 'Controller';

    $renderer = new TwigRenderer();

    /**
     * @var \App\controllers\Controller $controller
     */

    if(class_exists($controllerClass)) {
        $controller = new $controllerClass($renderer, $this);
        echo $controller->run($actionName);
    } else {
        echo $renderer->render('404');
    }
  }

  public function getConfig ($name = '')
  {
    if(empty($name)) {
      return $this->config;
    }

    if(empty($this->config[$name])) {
      return [];
    }

    return $this->config[$name];

  }

}
