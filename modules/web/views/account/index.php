<?php
\Yii::$app->getView()->registerJsFile('js/web/account.js',['depends'=>app\assets\WebAsset::className()]);
?>
<div class="row  border-bottom">
            <div class="col-lg-12">
                <div class="tab_title">
                    <ul class="nav nav-pills">
                        <li  class="current"  >
                            <a href="/web/account/index">账户列表</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<div class="row">
            <div class="col-lg-12">
                <form class="form-inline wrap_search">
                    <div class="row m-t p-w-m">
                        <div class="form-group">
                            <select name="status" class="form-control inline">
                                <option value="-1">请选择状态</option>
                                <option value="1"  >正常</option>
                                <option value="0"  >已删除</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="mix_kw" placeholder="请输入姓名或者手机号码" class="form-control" value="">
                                <input type="hidden" name="p" value="1">
                                <span class="input-group-btn">
                            <button type="button" class="btn btn-primary search" onclick="account.submit()">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-w-m btn-outline btn-primary pull-right" href="/web/account/set">
                                <i class="fa fa-plus"></i>账号
                            </a>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered m-t" id="lists_table">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>姓名</th>
                        <th>手机</th>
                        <th>邮箱</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $user_in):?>
                    <tr>
                        <td><?=$user_in['uid']?></td>
                        <td><?=$user_in['nickname']?></td>
                        <td><?=$user_in['mobile']?></td>
                        <td><?=$user_in['email']?></td>
                        <td>
                            <a  href="<?=\app\common\services\UrlService::buildWeb('/account/info')."?id=".$user_in['uid']?>">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                            <a class="m-l" href="<?=\app\common\services\UrlService::buildWeb('/account/set')."?id=".$user_in['uid']?>">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a class="m-l remove" href="javascript:void(0);" data="<?=$user_in['uid']?>">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <span class="pagination_count" style="line-height: 40px;">共2条记录 | 每页50条</span>
                        <ul class="pagination pagination-lg pull-right" style="margin: 0 0 ;">
                            <li class="active"><a href="javascript:void(0);">1</a></li>
                        </ul>
                    </div>
                </div>	</div>
        </div>
