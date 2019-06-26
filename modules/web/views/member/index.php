<?php
\Yii::$app->getView()->registerJsFile('js/web/member.js',['depends'=>app\assets\WebAsset::className()]);
?>
        <div class="row  border-bottom">
            <div class="col-lg-12">
                <div class="tab_title">
                    <ul class="nav nav-pills">
                        <li  class="current"  >
                            <a href="/web/member/index">会员列表</a>
                        </li>
                        <li  >
                            <a href="/web/member/comment">会员评论</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline wrap_search">
                    <div class="row  m-t p-w-m">
                        <div class="form-group">
                            <select name="status" class="form-control inline">
                                <option value="-1">请选择状态</option>
                                <option value="1"  >正常</option>
                                <option value="0"  >已删除</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="mix_kw" placeholder="请输入关键字" class="form-control" value="">
                                <span class="input-group-btn">
                            <button type="button" class="btn  btn-primary search" onclick="member.search()">
                                <i class="fa fa-search"></i>搜索
                            </button>
                        </span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-w-m btn-outline btn-primary pull-right" href="/web/member/set">
                                <i class="fa fa-plus"></i>会员
                            </a>
                        </div>
                    </div>

                </form>
                <table class="table table-bordered m-t">
                    <thead>
                    <tr>
                        <th>头像</th>
                        <th>姓名</th>
                        <th>手机</th>
                        <th>性别</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($list){
                        foreach ($list as $v){
                            if ($v['sex']==1){
                                $sex = "男";
                            }else if($v['sex']==2){
                                $sex = "女";
                            }else{
                                $sex = "未填写";
                            }
                        ?>
                    <tr>
                        <td><img alt="image" class="img-circle" src="/uploads/avatar/20170313/159419a875565b1afddd541fa34c9e65.jpg" style="width: 40px;height: 40px;"></td>
                        <td><?=$v['nickname']?></td>
                        <td><?=$v['mobile']?></td>
                        <td><?=$sex?></td>
                        <td><?=$v['status']?"正常":"失效"?></td>
                        <td>
                            <a  href="/web/member/info?id=<?=$v['id']?>">
                                <i class="fa fa-eye fa-lg"></i>
                            </a>
                            <a class="m-l" href="/web/member/set?id=<?=$v['id']?>">
                                <i class="fa fa-edit fa-lg"></i>
                            </a>

                            <a class="m-l remove" href="javascript:void(0);" data="1">
                                <i class="fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                    <?php }
                    }else{ ?>
                        <tr><td colspan="6" align="center">暂无数据</td></tr>
                    <?php } ?>
                    </tbody>
                </table>

                <!--分页显示 stat-->
                <form class="form-inline text-center">
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-primary btn-block"
                                onclick="member.history(1,1)">
                            &lt;&lt;
                        </button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-primary btn-block"
                                onclick="member.history(2,1)">&lt;
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                                        <span class="input-group-addon">
                                            共
                                            <span id="order_history_lists_pageTotal"></span>
                                            页
                                        </span>
                            <input type="number" min="1" class="form-control"
                                   id="order_history_lists_pageNo"
                                   placeholder="请输入要跳转的页码"
                                   value="1" style="text-align: center;"/>

                            <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary btn-block"
                                                    onclick="member.history(3,0)">
                                                翻 页
                                            </button>
                                        </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-primary btn-block"
                                onclick="member.history(2,2)">
                            &gt;
                        </button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-primary btn-block"
                                onclick="member.history(1,2)">
                            &gt;&gt;
                        </button>
                    </div>
                </form>
                <!--分页显示 end-->
            </div>
        </div>