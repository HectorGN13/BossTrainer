<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "user_gym".
 *
 * @property int $user_id
 * @property int $gym_id
 * @property string|null $created_at
 *
 * @property Gym $gym
 * @property User $user
 */
class GymUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_gym';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gym_id'], 'required'],
            [['user_id', 'gym_id'], 'default', 'value' => null],
            [['user_id', 'gym_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_id', 'gym_id'], 'unique', 'targetAttribute' => ['user_id', 'gym_id']],
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
            'user_id' => 'User ID',
            'gym_id' => 'Gym ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Gym]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGym()
    {
        return $this->hasOne(Gym::className(), ['id' => 'gym_id'])->inverseOf('gymUsers');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('gymUsers');
    }

}
