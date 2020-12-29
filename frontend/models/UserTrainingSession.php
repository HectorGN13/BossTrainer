<?php

namespace frontend\models;

use common\models\TrainingSession;
use common\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_training_session".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $training_session_id
 *
 * @property TrainingSession $trainingSession
 * @property User $user
 */
class UserTrainingSession extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_training_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'training_session_id'], 'default', 'value' => null],
            [['user_id', 'training_session_id'], 'integer'],
            [['training_session_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrainingSession::className(), 'targetAttribute' => ['training_session_id' => 'id']],
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
            'training_session_id' => 'Training Session ID',
        ];
    }

    /**
     * Gets query for [[TrainingSession]].
     *
     * @return ActiveQuery
     */
    public function getTrainingSession()
    {
        return $this->hasOne(TrainingSession::className(), ['id' => 'training_session_id'])->inverseOf('userTrainingSessions');
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('userTrainingSessions');
    }
}
