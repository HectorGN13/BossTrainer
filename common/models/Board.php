<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "board".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 *
 * @property GymBoard[] $gymBoards
 * @property Gym[] $gyms
 */
class Board extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'board';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 4000],
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
            'body' => 'Body',
        ];
    }

    /**
     * Gets query for [[GymBoards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGymBoards()
    {
        return $this->hasMany(GymBoard::className(), ['board_id' => 'id'])->inverseOf('board');
    }

    /**
     * Gets query for [[Gyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGyms()
    {
        return $this->hasMany(Gym::className(), ['id' => 'gym_id'])->viaTable('gym_board', ['board_id' => 'id']);
    }
}
