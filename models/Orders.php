<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $room_id
 * @property string|null $date_start
 * @property string|null $date_finish
 * @property int|null $guests_count
 * @property string|null $customer_phone
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id'], 'required'],
            [['room_id', 'guests_count'], 'default', 'value' => null],
            [['room_id', 'guests_count'], 'integer'],
            [['date_start', 'date_finish'], 'safe'],
            [['customer_phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'date_start' => 'Date Start',
            'date_finish' => 'Date Finish',
            'guests_count' => 'Guests Count',
            'customer_phone' => 'Customer Phone',
        ];
    }
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['room_id' => 'id'])->one();
    }
}
