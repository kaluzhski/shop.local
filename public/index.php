<?php
include dirname(__DIR__) . '/vendor/autoload.php';

$config = include dirname(__DIR__) . '/config/Main.php';

(new \App\core\App())->run($config);
