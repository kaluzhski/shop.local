<?php

namespace App\services;

use App\entities\Order;

class OrderService
{
  public function add($request, $orderRepository)
  {

      $order = new Order();
      $order->user_id = 5;

      var_dump($order);

      $orderRepository->insert($order);

      $request->sessionDestroy();

      return true;
  }

}
