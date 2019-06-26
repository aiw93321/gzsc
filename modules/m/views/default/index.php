<?php
use \app\common\services\UrlService;
use \yii\helpers\Html;
\Yii::$app->getView()->registerJsFile('js/m/default.js',['depends'=>app\assets\WebAsset::className()]);
?>
<div style="min-height: 500px;">
    <div class="shop_header">
        <i class="shop_icon"></i>
        <strong><?=Html::encode($list['name'])?></strong>
    </div>


    <div id="slideBox" class="slideBox">
        <div class="bd">
            <ul>
                <?php if ($img){ ?>
                    <?php foreach( $img as $_item ):
                        ?>
                        <li><img style="max-height: 250px;" src="<?=UrlService::buildPicUrl('brand',$_item['image_key'])?>" /></li>
                    <?php endforeach;?>
                <?php }else{ ?>
                    <li><img style="max-height: 250px;" src="/images/common/20190614144318.jpg" /></li>
                <?php } ?>
            </ul>
        </div>
        <div class="hd"><ul></ul></div>
    </div>
    <div class="fastway_list_box">
        <ul class="fastway_list">
            <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>品牌名称：<?=Html::encode($list['name'])?></span></a></li>
            <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>联系电话：<?=Html::encode($list['mobile'])?></span></a></li>
            <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>联系地址：<?=Html::encode($list['address'])?></span></a></li>
            <li><a href="javascript:void(0);" style="padding-left: 0.1rem;"><span>品牌介绍：<?=Html::encode($list['description'])?></span></a></li>
        </ul>
    </div></div>
<div class="copyright clearfix">
    <p class="name">欢迎您，郭威</p>
    <p class="copyright">由<a href="/" target="_blank">编程浪子</a>提供技术支持</p>
</div>
<div class="footer_fixed clearfix">
    <span><a href="/m/" class="default"><i class="home_icon"></i><b>首页</b></a></span>
    <span><a href="/m/product/index" class="product"><i class="store_icon"></i><b>图书</b></a></span>
    <span><a href="/m/user/index" class="user"><i class="member_icon"></i><b>我的</b></a></span>
</div>

