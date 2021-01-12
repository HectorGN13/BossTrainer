<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * Esta es la clase de modelo para la tabla "weight".
 * This is the model class for table "weight".
 *
 * @property int $id
 * @property int $user_id
 * @property int $value
 * @property int $create_at
 *
 * @property User $user
 */
class Weight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'value', 'create_at'], 'required'],
            [['user_id', 'value', 'create_at'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['value'], 'integer','min' => 1, 'max' => 500, 'message' => 'El valor no puede ser inferior a 1 ni superior a 500'],
            [['create_at'], 'safe'],
            [['create_at'], 'date', 'format' => 'php:Y-m-d'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'value' => 'Valor',
            'create_at' => 'Fecha',
        ];
    }

    /**
     * Obtiene una consulta para [[User]].
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('weights');
    }
}
