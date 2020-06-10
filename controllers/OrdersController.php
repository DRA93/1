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
            $max_id = Orders::find()->select('id')->orderBy('id DESC')->limit(1)->one();

            $x = new Orders();
            $x->id = $max_id->id+1;
            $x->room_id = $request->post('room_id');
            $x->date_start = $request->post('date_start');
            $x->date_finish = $request->post('date_finish');
            $x->guests_count = $request->post('guests_count');
            $x->customer_phone = $request->post('customer_phone');

        $model=Orders::find()->where(['room_id'=>$x->room_id])->all();
        foreach ($model as $order):{
            if ((($x->date_start >= $order->date_start) & ($x->date_start < $order->date_finish))
                || (($x->date_finish > $order->date_start) & ($x->date_finish <= $order->date_finish)))
                return 'Есть пересечения';

        }

        endforeach;
        $x->save();
        return ('Бронирование успешно');
}

}
