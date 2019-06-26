<?php

namespace app\modules\m\controllers;

use app\common\models\BrandImages;
use app\common\models\BrandSetting;
use app\modules\m\controllers\common\BaseController;

/**
 * Default controller for the `m` module
 */
class DefaultController extends BaseController
{
    public $layout ='main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $list = BrandSetting::find()->one();
        $img = BrandImages::find()->orderBy(['id'=>SORT_DESC])->all();
        return $this->render('index',[
            'list'=>$list,
            'img'=>$img
        ]);
    }
}
