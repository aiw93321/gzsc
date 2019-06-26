<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14
 * Time: 13:42
 */

namespace app\modules\m\controllers\common;
use app\common\components\BaseWebController;

class BaseController extends BaseWebController
{
    public function beforeAction($action)
    {
        return true;
    }
}