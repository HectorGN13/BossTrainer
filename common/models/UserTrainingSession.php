<?php

namespace common\models;

use Yii;
use common\models\User;
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
class UserTrainingSession extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSession()
    {
        return $this->hasOne(TrainingSession::className(), ['id' => 'training_session_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    //get training session members
    public function getSessionMembers($sessionId)
    {
        $users = UserTrainingSession::find()
        ->joinWith('user')
        ->where(['training_session_id' => $sessionId])
        ->all();
        return $users;
    }
    //check user have joined session or not
    public function isSessionIsJoined($sessionId, $userId)
    {
        $userCount = UserTrainingSession::find()
        ->where(['training_session_id' => $sessionId])
        ->andWhere(['user_id' => $userId])
        ->count();
        return ($userCount > 0) ? true : false;
    }
}
