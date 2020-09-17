<?php

namespace App\repositories;

use App\entities\Order;

class OrderRepository extends Repository
{
  public function getTableName()
  {
    return 'orders_tbl';
  }

  public function getEntityName()
  {
    return Order::class;
  }
}
