<?php

namespace App\controllers;

use App\repositories\GoodRepository;
use App\entities\Good;


class GoodController extends Controller
{
    public function allAction() {
        $goods = $this->getRepository('Good')->getAllObj();
        return $this->render(
          'goodAll',
          [
            'goods' => $goods,
            'title' => $this->app->getConfig('title'),
            'menu' => $this->getMenu()
          ]
        );
    }

    public function oneAction() {
        $id = $_GET['id'];
        $good = $this->getRepository('Good')->getOneObj($id);
        return $this->render('goodOne', [
          'good' => $good,
          'menu' => $this->getMenu()
        ]);
    }

    public function addAction()
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $good = new Good();
        $good->good_name = $_POST['good_name'];
        $good->good_description = $_POST['good_description'];
        $good->good_price = $_POST['good_price'];

        $this->getRepository('Good')->save($good);

      header('location: /gbphp/good/all');
    }

      return $this->render('goodAdd', ['menu' => $this->getMenu()]);

    }

}
