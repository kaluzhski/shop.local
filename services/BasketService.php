<?php

namespace App\services;

class BasketService
{
  public function add($request, $goodRepository )
  {
      $id = $request->getId();
      if (empty($id)) {
          return false;
      }

      $good = $goodRepository->getOneObj($id);
      if (empty($good)) {
          return false;
      }

      $goods = $request->getSession('goods');

      if (empty($goods[$id])) {
          $goods[$id] = [
              'id' => $good->id,
              'good' => $good->good_name,
              'count' => 1
          ];
      } else {
          $goods[$id]['count']++;
      }

      $request->setSession('goods', $goods);

      return true;
  }


  public function remove($request)
  {
      $id = $request->getId();
      if (empty($id)) {
          return false;
      }

      $goods = $request->getSession('goods');

      if (!empty($goods[$id])) {
        if($goods[$id]['count'] != 1) {
          $goods[$id]['count']--;
        } else {
          unset($goods[$id]);
        }
      }

      $request->setSession('goods', $goods);

      return true;
  }

  public function delete($request)
  {
      $id = $request->getId();
      if (empty($id)) {
          return false;
      }

      $goods = $request->getSession('goods');

      if (!empty($goods[$id])) {
          unset($goods[$id]);
      }

      $request->setSession('goods', $goods);

      return true;
  }

}
