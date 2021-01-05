<?php

namespace frontend\models;

use common\models\TrainingSession;
use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Esta es la clase model para la tabla "waiting_list".
 * This is the model class for table "waiting_list".
 *
 * @property int $id
 * @property int $user_id
 * @property int $training_session_id
 *
 * @property TrainingSession $trainingSession
 * @property User $user
 */
class WaitingList extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'waiting_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'training_session_id'], 'required'],
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
     * Obtiene la query para [[TrainingSession]].
     * Gets query for [[TrainingSession]].
     *
     * @return ActiveQuery
     */
    public function getTrainingSession()
    {
        return $this->hasOne(TrainingSession::className(), ['id' => 'training_session_id'])->inverseOf('waitingLists');
    }

    /**
     * Obtiene la query para [[User]].
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('waitingLists');
    }
}
