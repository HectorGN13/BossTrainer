<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "movements".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $measure
 * @property string|null $video
 * @property string|null $img
 * @property string|null $type
 *
 * @property Record[] $records
 * @property User[] $users
 */
class Movements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'measure'], 'required'],
            [['img'], 'string'],
            [['title'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 400],
            [['measure'], 'string', 'max' => 12],
            [['video', 'type'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'measure' => 'Measure',
            'video' => 'Video',
            'img' => 'Img',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Records]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecords()
    {
        return $this->hasMany(Record::className(), ['movements_id' => 'id'])->inverseOf('movements');
    }


    /**
     * Gets query for [[Records]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordsMovements()
    {
         $query = $this->hasMany(Record::className(), ['movements_id' => 'id'])
            ->select('value')
            ->onCondition(['movements_id' => $this->id])
            ->inverseOf('movements')
            ->column();

        return array_shift($query);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('record', ['movements_id' => 'id']);
    }

    public function recordValue($model)
    {
        $movement = $model->id;
        $user_id = Yii::$app->user->id;
        $records = \common\models\Record::find()
            ->select('value')
            ->where(['user_id' => $user_id])
            ->andFilterWhere(['movements_id' => $movement])
            ->indexBy('movements_id')
            ->column();
        $records = array_shift($records);
        return $records;
    }
}
