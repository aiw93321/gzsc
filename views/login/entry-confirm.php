<?php
use yii\helpers\Html;
?>
<p>恭喜你注册成功:</p>

<ul>
    <li><label>用户名：</label>: <?= Html::encode($model->name) ?></li>
    <li><label>密码：</label>: <?= Html::encode($model->password) ?></li>
</ul>