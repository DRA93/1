<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property bool|null $valid
 */
class Hotels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valid'], 'boolean'],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'valid' => 'Valid',
        ];
    }
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'hotel_id'])->all();
    }
}
