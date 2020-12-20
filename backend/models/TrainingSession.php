<?php

namespace backend\models;

use Yii;
use backend\models\UserTrainingSession;
use common\models\User;
use yii\db\Query;
/**
 * This is the model class for table "training_session".
 *
 * @property int $id
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 * @property int|null $capacity
 * @property int|null $created_by
 *
 * @property UserTrainingSession[] $userTrainingSessions
 */
class TrainingSession extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery
     */
    public function getUserTrainingSessions()
    {
        $training_session_id = $this->id;
        $collection = UserTrainingSession::find()
        ->joinWith('user')
        ->where(['training_session_id' => $training_session_id])
        ->all();
        return $collection;
        
        //return $this->hasMany(UserTrainingSession::className(), ['training_session_id' => 'user_id']);
    }
}