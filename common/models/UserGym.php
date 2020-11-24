<?php

namespace app\models;

use common\models\Gym;
use common\models\User;
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
class UserGym extends \yii\db\ActiveRecord
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
            [['gym_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gym::class, 'targetAttribute' => ['gym_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
        return $this->hasOne(Gym::class, ['id' => 'gym_id'])->inverseOf('userGyms');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('userGyms');
    }
}
