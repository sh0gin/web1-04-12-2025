<?php

// comment out the following two lines when deployed to production

use yii\helpers\VarDumper;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
// VarDumper::dump($_SERVER['REQUEST_URI']); die;

if ($_SERVER['REQUEST_URI'] == '/school-api') {
    $config = require __DIR__ . '/../config/web.php';
} else {
    $config = require __DIR__ . '/../config/web_panel.php';
}

(new yii\web\Application($config))->run();