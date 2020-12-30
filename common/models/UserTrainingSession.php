<?php

namespace common\models;

use frontend\models\WaitingList;
use Yii;
use common\models\User;
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
            [['user_id', 'training_session_id', 'rating'], 'default', 'value' => null],
            [['user_id', 'training_session_id', 'rating'], 'integer'],
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
            'rating' => 'Puntuación',
        ];
    }

    /**
     * Gets query for [[TrainingSession]].
     *
     * @return ActiveQuery
     */
    public function getTrainingSession()
    {
        return $this->hasOne(TrainingSession::className(), ['id' => 'training_session_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $sessionId
     * @return array|ActiveRecord[]
     */
    public function getSessionMembers($sessionId)
    {
        return UserTrainingSession::find()
        ->joinWith('user')
        ->where(['training_session_id' => $sessionId])
        ->all();
    }

    /**
     * @param $sessionId
     * @param $userId
     * @return bool
     */
    public function isSessionIsJoined($sessionId, $userId)
    {
        $userCount = UserTrainingSession::find()
        ->where(['training_session_id' => $sessionId])
        ->andWhere(['user_id' => $userId])
        ->count();
        return $userCount > 0;
    }

    /**
     *
     */
    public function afterDelete()
    {
        $name = TrainingSession::find()
            ->select('title')
            ->where([ 'id' => $this->training_session_id])
            ->scalar();

        $recipients = WaitingList::find()
            ->where(['training_session_id' => $this->training_session_id])
            ->all();

        foreach ($recipients as $recipient) {
            $notification = new Notification();
            $notification->recipient = $recipient['user_id'];
            $notification->title = "¡Plaza libre!";
            $notification->body = "¡Bien! ha quedado una plaza libre en la sesión de entrenamiento " . $name . ".";

            $notification->save();

        }

        return parent::afterDelete();
    }
}
