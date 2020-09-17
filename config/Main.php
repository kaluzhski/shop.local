<?php

return [
  'title' => 'Online Shop',
  'defaultControllerName' => 'goods',
  'components' => [
    'db' => [
      'class' => App\services\DB::class,
      'config' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'gbphp_db',
        'charset' => 'UTF8',
        'username' => 'root',
        'password' => '',
      ]
    ],
    'twigRenderer' => [
      'class' => App\services\renderers\TwigRenderer::class,
    ],
    'request' => [
      'class' => App\services\Request::class
    ],
    'GoodRepository' => [
      'class' => App\repositories\GoodRepository::class
    ],
    'UserRepository' => [
      'class' => App\repositories\UserRepository::class
    ],
    'OrderRepository' => [
      'class' => App\repositories\OrderRepository::class
    ],
    'basketService' => [
      'class' => App\services\BasketService::class
    ],
    'orderService' => [
      'class' => App\services\OrderService::class
    ]
  ]

];
