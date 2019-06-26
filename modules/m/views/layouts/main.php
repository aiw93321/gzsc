<?php
//引用前端资源管理的文件
use app\assets\MAsset;
MAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <title>编程浪子微信图书商城</title>
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/m/css_style.css" rel="stylesheet">
    <link href="/css/m/app.css?ver=20170401" rel="stylesheet">
    </head>
<body>
<?php $this->beginBody(); ?>
<!--这是开始的位置-->
<?=$content;?>
<!--这是结束的位置-->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage();?>