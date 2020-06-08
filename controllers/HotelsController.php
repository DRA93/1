<?php
namespace app\controllers;

use app\models\Hotels;

use yii\rest\ActiveController;

class HotelsController extends ActiveController
{
   public $modelClass = 'app\models\Hotels';
    public function actionGetHotels(){
        $model = Hotels::find()->where(['valid'=>'true'])->all();
        return $model;}




}