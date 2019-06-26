<?php
\Yii::$app->getView()->registerJsFile('js/web/brand.js',['depends'=>app\assets\WebAsset::className()]);
use app\common\services\UrlService;
?>
    <div class="row  border-bottom">
            <div class="col-lg-12">
                <div class="tab_title">
                    <ul class="nav nav-pills">
                        <li  class="current"  >
                            <a href="/web/brand/info">品牌信息</a>
                        </li>
                        <li  >
                            <a href="/web/brand/images">品牌相册</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="row m-t  wrap_brand_set">
            <div class="col-lg-12">
                <h2 class="text-center">品牌设置</h2>
                <div class="form-horizontal m-t m-b">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌名称:</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" class="form-control" placeholder="请输入品牌名称~~" value="<?=$brand['name']?$brand['name']:''?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌Logo:</label>
                        <div class="col-lg-10">
                            <form class="upload_pic_wrap" target="upload_file" enctype="multipart/form-data" method="POST" action="<?=UrlService::buildWeb('/upload/pic')?>">
                                <div class="upload_wrap pull-left">
                                    <i class="fa fa-upload fa-2x"></i>
                                    <input type="hidden" name="bucket" value="brand" />
                                    <input type="file" name="pic" accept="image/png, image/jpeg, image/jpg,image/gif">
                                </div>
                                <?php if ($brand && $brand['logo']):?>
                                <span class="pic-each">
							<img src="<?=UrlService::buildPicUrl('brand',$brand['logo'])?>">
							<span class="fa fa-times-circle del del_image" data="<?=$brand['logo']?>" ><i></i></span>
						</span>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">电话:</label>
                        <div class="col-lg-10">
                            <input type="text" name="mobile" class="form-control" placeholder="请输入联系电话~~"  value="<?=$brand['mobile']?$brand['mobile']:''?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">地址:</label>
                        <div class="col-lg-10">
                            <input type="text" name="address" class="form-control" placeholder="请输入联系地址~~"  value="<?=$brand['address']?$brand['address']:''?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">品牌介绍:</label>
                        <div class="col-lg-10">
                            <textarea  name="description" class="form-control" rows="4"><?=$brand['description']?$brand['description']:''?></textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                            <button class="btn btn-w-m btn-outline btn-primary save" onclick="brand.set_submit()">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<iframe class="hide" name="upload_file"></iframe>
<script type="text/javascript">
   var upload = {
        error:function (msg) {
            layer.msg(msg);
        },
        success:function (image_key) {
            var html = '<img src="'+common_ops.buildPicUrl('brand',image_key)+'"><span class="fa fa-times-circle del del_image" data="'+image_key+'"><i></i></span>';
            if ($(".upload_pic_wrap .pic-each").size()>0){
                $(".upload_pic_wrap .pic-each").html(html);
            } else {
                $(".upload_pic_wrap").append('<span class="pic-each" >'+html+"</span>");
            }
            brand.del_img();
        }
    };
</script>