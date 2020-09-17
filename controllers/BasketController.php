<?php

namespace App\controllers;

use App\entities\Good;
use App\repositories\GoodRepository;

class BasketController extends Controller
{

  public function addAction()
  {
      $request = $this->app->request;
      $goodRepository = $this->getRepository('Good');
      $hasAdd = $this->app->basketService->add($request, $goodRepository);

      if (!$hasAdd) {
          return $this->render('404');
      }

      $request->redirectApp('The item has been added into your basket');
      return '';
  }


  public function removeAction()
  {
    $request = $this->app->request;
    $hasRemoved = $this->app->basketService->remove($request);

    if (!$hasRemoved) {
        return $this->render('404');
    }

    $request->redirectApp('The item has been deleted from your basket');
    return '';

  }

    public function deleteAction()
    {
      $request = $this->app->request;
      $hasDeleted = $this->app->basketService->delete($request);

      if (!$hasDeleted) {
          return $this->render('404');
      }

    $request->redirectApp('The item has been deleted from your basket');
    return '';
  }

  public function allAction()
  {
      if (!empty($_SESSION['goods'])){
        return $this->render('basket', ['basket' => $_SESSION['goods'], 'menu' => $this->getMenu()]);
    } else {
      return $this->render('basket', ['basket' => null, 'menu' => $this->getMenu()]);
    }
  }


}
