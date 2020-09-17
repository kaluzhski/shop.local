<?php

namespace App\repositories;

use App\entities\User;

class UserRepository extends Repository
{
  public function getTableName()
  {
    return 'users_tbl';
  }

  public function getEntityName()
  {
    return User::class;
  }
}
