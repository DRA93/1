<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property int $hotel_id
 * @property int|null $area
 * @property int|null $places
 * @property string|null $class
 * @property bool|null $smoking
 * @property int|null $price
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id'], 'required'],
            [['hotel_id', 'area', 'places', 'price'], 'default', 'value' => null],
            [['hotel_id', 'area', 'places', 'price'], 'integer'],
            [['smoking'], 'boolean'],
            [['class'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_id' => 'Hotel ID',
            'area' => 'Area',
            'places' => 'Places',
            'class' => 'Class',
            'smoking' => 'Smoking',
            'price' => 'Price',
        ];
    }
    public function getHotels()
    {
        return $this->hasOne(Hotels::className(), ['hotel_id' => 'id'])->one();
    }
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id' => 'room_id'])->all();
    }
}
