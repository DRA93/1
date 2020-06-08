<?php
namespace app\controllers;
use app\models\Orders;
use Yii;
use yii\rest\ActiveController;

class OrdersController extends ActiveController
{
    public $modelClass = 'app\models\Orders';

    public function actionGetorders(){
        if ($model = Orders::find()->where(['room_id'=>$_GET['id']])->all())

            return $model;
        else return 'Бронирование отсутствует';

    }
    public function actionOrdering(){
        $request = Yii::$app->request;




        $model=Orders::find()->where(['room_id'=>$request->post('room_id')])->all();
        foreach ($model as $order):{
            if (!($request->post('date_start') >= $order->date_finish) || !($request->post('date_finish') <= $order->date_start))
                return 'Есть пересечения';
            else return 'ok';}
        endforeach;
    }

}