<?php

namespace App\controllers;

use App\services\renderers\TemplateRenderer;


/**
*@var App
*@property TemplateRenderer $renderer
*/

abstract class Controller
{
    protected $defaultAction = 'all';
    public $renderer;
    protected $app;

    public function __construct($renderer, $app)
    {
        $this->renderer = $renderer;
        $this->app = $app;
    }

    public function run ($actionName)
    {

        $action = $actionName;

        if(!method_exists($this, $action . 'Action')) {
            $action = $this->defaultAction;
            echo $this->renderer->render('404');
        } else {
            $action .= 'Action';
            return $this->$action();
          }

    }

    protected function render ($template, $params)
    {
        return $this->renderer->render($template, $params);
    }

    protected function getMenu ()
    {
      return [
        [
          'name' => 'All Users',
          'href' => '/user/all'
        ],
        [
          'name' => 'All Goods',
          'href' => '/good/all'
        ],
        [
          'name' => 'Add Good',
          'href' => '/good/add'
        ],
        [
          'name' => 'Basket',
          'href' => '/basket/all'
        ]

      ];
    }

    public function getRepository ($repositoryName)
    {
      return $this->app->db->getRepository($repositoryName);
    }

}
