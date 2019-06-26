<?php
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
//define('YII_ENABLE_EXCEPTION_HANDLER',false);
$config = require __DIR__ . '/../config/web.php';
//版本号控制
if (file_exists('D:\WWW\version.txt')){
define('VERSION',trim(file_get_contents('D:\WWW\version.txt')));
}else{
    define('VERSION',time());
}
(new yii\web\Application($config))->run();
