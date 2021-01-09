<?php

namespace backend\models;

use common\models\Gym;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "type_rate".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $gym_id
 * @property int $price
 *
 * @property Rate[] $rates
 * @property Gym $gym
 */
class TypeRate extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'gym_id', 'price'], 'required'],
            [['gym_id', 'price'], 'default', 'value' => null],
            [['gym_id'], 'integer'],
            [['price'], 'integer', 'min' => 1],
            [['title'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['gym_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gym::className(), 'targetAttribute' => ['gym_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Nombre de la tarifa',
            'description' => 'Descripción de la tarifa',
            'gym_id' => 'Gym ID',
            'price' => 'Precio €',
        ];
    }

    /**
     * Gets query for [[Rates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['type' => 'id'])->inverseOf('type0');
    }

    /**
     * Gets query for [[Gym]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGym()
    {
        return $this->hasOne(Gym::className(), ['id' => 'gym_id'])->inverseOf('typeRates');
    }
}
