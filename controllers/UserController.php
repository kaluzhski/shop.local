<?php

namespace App\controllers;

use App\repositories\UserRepository;

class UserController extends Controller
{
    public function allAction ()
    {
        $users = $this->getRepository('User')->getAllObj();

        return $this->render('userAll', [
          'users' => $users,
          'menu' => $this->getMenu()
        ]);
    }

    public function oneAction ()
    {
        $id = (int)$_GET['id'];
        $user = $this->getRepository('User')->getOneObj($id);

        return $this->render('userOne', [
          'user' => $user,
          'menu' => $this->getMenu()
        ]);
    }

}
