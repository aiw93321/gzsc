<?php

namespace app\modules\web\controllers;

use app\common\models\BrandSetting;
use app\common\models\BrandImages;
use app\modules\web\controllers\common\BaseController;
use yii\helpers\Html;

/**
 * Default controller for the `web` module
 */
class BrandController extends BaseController
{
    public $layout ='main';
    //品牌展示页面
    public function actionInfo()
    {
        //查询最新品牌消息
        $Brand = BrandSetting::find()->one();
        return $this->render('info',['brand'=>$Brand]);
    }

    //品牌编辑界面
    public function actionSet()
    {
        $brand = BrandSetting::find()->one();
        return $this->render('set',['brand'=>$brand]);
    }

    //品牌编辑信息
    public function actionSetSubmit(){
        $name = Html::encode($this->post('name'));
        $image_key = trim($this->post('image_key'));
        $mobile = Html::encode($this->post('mobile'));
        $address = Html::encode($this->post('address'));
        $description = Html::encode($this->post('description'));
        $date_time = date('Y-m-d H:i:s');
        $info = BrandSetting::find()->one();
        if ($info){
            $model_brand = $info;
        }else{
            $model_brand = new BrandSetting();
            $model_brand->created_time = $date_time;
        }
        $model_brand->name = $name ;
        $model_brand->logo = $image_key;
        $model_brand->mobile = $mobile;
        $model_brand->address = $address;
        $model_brand->description = $description;
        $model_brand->updated_time = $date_time;
        $model_brand->save(0);
        return $this->renderJson([],'操作成功',200);
    }

    //品牌图片
    public function actionImages()
    {
        $list = BrandImages::find()->orderBy([ 'id' => SORT_DESC ])->all();
        return $this->render('images',['list'=>$list]);
    }

    public function actionImgSubmit(){
        $image_key = trim($this->post('image_key'));
        $date_time = date('Y-m-d H:i:s');
        $lists = BrandImages::find()->all();
        if (count($lists)>=5){
            return $this->renderJson([],'当前已到达最大上传！',-1);
        }
        $Bimg = new BrandImages();
        $Bimg->image_key = $image_key;
        $Bimg->created_time=$date_time;
        $Bimg->save(0);
        return $this->renderJson([],'操作成功',200);
    }

    public function actionImgDel(){
        $id = trim($this->post('id'));
        $delete_id = BrandImages::findOne(['id'=>$id]);
        if (!$delete_id){
            return $this->renderJson([],'当前删除的文件不存在！',-1);
        }
        $count=BrandImages::deleteAll(['id'=>$id]);
        if ($count){
            return $this->renderJson([],'操作成功',200);
        }
    }
}
