<?php

namespace App\repositories;

use App\entities\Good;

class GoodRepository extends Repository
{
  public function getTableName()
  {
    return 'goods_tbl';
  }

  public function getEntityName()
  {
    return Good::class;
  }
}
