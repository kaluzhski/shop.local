<?php

namespace App\services;

class Request
{
  private $queryString;
  private $controllerName = 'good';
  private $actionName = 'all';
  private $params;
  private $id;

  public function __construct()
  {
    session_start();
    $this->queryString = $_SERVER['REQUEST_URI'];
    $this->prepareRequest();
  }

  public function prepareRequest ()
  {
    $this->params = [
      'get' => $_GET,
      'post' => $_POST,
    ];

    $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
    preg_match_all($pattern, $this->queryString, $matches);

    if(!empty($matches['controller'][0])) {
      $this->actionName = $matches['action'][0];
      $this->controllerName = $matches['controller'][0];
      $this->params = $matches['params'][0];
    }

    if(!empty($_GET['id'])) {
      $this->id = (int)$_GET['id'];
    }
  }



  public function getAction ()
  {
    return $this->actionName;
  }

  public function getController ()
  {
    return $this->controllerName;
  }

  public function getId ()
  {
    return $this->id;
  }

  public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (empty($_SESSION[$key])) {
            return [];
        }

        return $_SESSION[$key];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function sessionDestroy()
    {
        session_destroy();
    }

    public function redirectApp($msg = '')
    {
        if (!empty($msg)) {
            $this->setSession('msg', $msg);
        }
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}
