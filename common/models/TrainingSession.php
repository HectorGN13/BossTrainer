<?php

namespace common\models;

use frontend\models\WaitingList;
use macgyer\yii2materializecss\widgets\form\Select;
use Yii;
use common\models\UserTrainingSession;
use common\models\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
/**
 * This is the model class for table "training_session".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 * @property int|null $capacity
 * @property int|null $created_by
 *
 * @property UserTrainingSession[] $userTrainingSessions
 */
class TrainingSession extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'training_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'start_time', 'end_time','title'], 'required'],
            [['description', 'title'], 'string'],
            [['start_time', 'end_time'], 'safe'],
            [['capacity', 'created_by'], 'default', 'value' => null],
            [['capacity', 'created_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Nombre de la sesión',
            'description' => 'Descripción de la sesión',
            'start_time' => 'Hora de inicio',
            'end_time' => 'Hora de fin',
            'capacity' => 'Capacidad',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[UserTrainingSessions]].
     *
     * @return array|ActiveQuery|ActiveRecord[]
     */
    public function getUserTrainingSessions()
    {
        $training_session_id = $this->id;
        return UserTrainingSession::find()
            ->joinWith('user')
            ->where(['training_session_id' => $training_session_id])
            ->all();
        
        //return $this->hasMany(UserTrainingSession::className(), ['training_session_id' => 'user_id']);
    }

    /**
     * Gets query for [[WaitingLists]].
     *
     * @return ActiveQuery
     */
    public function getWaitingLists()
    {
        return $this->hasMany(WaitingList::className(), ['training_session_id' => 'id'])->inverseOf('trainingSession');
    }

    /**
     * @return bool
     */
    public function userWaitingExist()
    {
        return $this->getWaitingLists()->onCondition(['user_id' => Yii::$app->user->id])->exists();
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @return bool|void
     */
    public function afterSave($insert, $changedAttributes)
    {

       if ($insert == false && ($changedAttributes['capacity'] < $this->capacity)) {

           $name = TrainingSession::find()
               ->select('title')
               ->where([ 'id' => $this->id])
               ->scalar();

           $recipients = WaitingList::find()
               ->where(['training_session_id' => $this->id])
               ->all();

           foreach ($recipients as $recipient) {
               $notification = new Notification();
               $notification->recipient = $recipient['user_id'];
               $notification->title = "¡Plaza libre!";
               $notification->body = "¡Bien! ha quedado una plaza libre en la sesión de entrenamiento " . $name . ".";

               $notification->save();

           }

           return parent::beforeSave($insert);
       }
    }
}
