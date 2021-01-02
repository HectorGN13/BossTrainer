<?php

namespace backend\models;

use Yii;
use common\models\Gym;
use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rate".
 *
 * @property int $id
 * @property int $gym_id
 * @property int $user_id
 * @property string $title
 * @property string $type
 * @property string $price
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 *
 * @property Gym $gym
 * @property User $user
 */
class Rate extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gym_id', 'user_id', 'title', 'type', 'price', 'description', 'start_date', 'end_date'], 'required'],
            [['gym_id', 'user_id'], 'default', 'value' => null],
            [['gym_id', 'user_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
            [['type', 'price'], 'string', 'max' => 50],
            [['gym_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gym::className(), 'targetAttribute' => ['gym_id' => 'id']],
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
            'gym_id' => 'Gym ID',
            'user_id' => 'User ID',
            'title' => 'Nombre de la Tarifa',
            'type' => 'Tipo de Tarifa',
            'price' => 'Precio €',
            'description' => 'Descripción',
            'start_date' => 'Fecha de inicio',
            'end_date' => 'Fecha de finalización',
        ];
    }

    /**
     * Gets query for [[Gym]].
     *
     * @return ActiveQuery
     */
    public function getGym()
    {
        return $this->hasOne(Gym::class, ['id' => 'gym_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param $gymId
     * @param $userId
     * @return bool
     */
    public function isRateExpired($gymId, $userId)
    {
        $expiredRates = Rate::find()
            ->where(['user_id' => $userId])
            ->andWhere(['<', 'end_date', date('Y-m-d H:i:s')])
            ->andWhere(['gym_id' => $gymId])
            ->count();
        return $expiredRates > 0;
    }
}
