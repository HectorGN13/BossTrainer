<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rate".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $start_date
 * @property string $end_date
 *
 * @property TypeRate $type0
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
            [['user_id', 'type', 'start_date', 'end_date'], 'required'],
            [['user_id', 'type'], 'default', 'value' => null],
            [['user_id', 'type'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeRate::className(), 'targetAttribute' => ['type' => 'id']],
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
            'type' => 'Tipo de Tarifa',
            'start_date' => 'Fecha de inicio',
            'end_date' => 'Fecha de finalización',
        ];
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(TypeRate::class, ['id' => 'type'])->inverseOf('rates');
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
            ->joinWith('type0 t')
            ->where(['user_id' => $userId])
            ->andWhere(['<', 'end_date', date('Y-m-d H:i:s')])
            ->andWhere(['t.gym_id' => $gymId])
            ->count();
        return $expiredRates > 0;
    }
}
