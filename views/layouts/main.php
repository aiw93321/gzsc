<?php
//引用前端资源管理的文件
use app\assets\AppAsset;
use app\common\services\UrlService;
AppAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>编程浪子微信图书商城</title>
<!--    <link href="/css/www/app.css" rel="stylesheet">-->
    <?php $this->head();?>
</head>
<body>
<?php $this->beginBody(); ?>
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse pull-left">
            <ul class="nav navbar-nav ">
                <li><a href="<?=UrlService::build3WUrl('/')?>">首页</a></li>
                <li><a target="_blank" href="#">关于我们</a></li>
                <li><a href="<?=UrlService::build3WUrl('/web/user/login')?>">管理后台</a></li>
            </ul>
        </div>
    </div>
</div>
<!--这是开始-->
<?=$content;?>
<!--这是结束-->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage();?>