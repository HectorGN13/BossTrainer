<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gym_board".
 *
 * @property int $gym_id
 * @property int $board_id
 *
 * @property Board $board
 * @property Gym $gym
 */
class GymBoard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gym_board';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gym_id', 'board_id'], 'required'],
            [['gym_id', 'board_id'], 'default', 'value' => null],
            [['gym_id', 'board_id'], 'integer'],
            [['gym_id', 'board_id'], 'unique', 'targetAttribute' => ['gym_id', 'board_id']],
            [['board_id'], 'exist', 'skipOnError' => true, 'targetClass' => Board::className(), 'targetAttribute' => ['board_id' => 'id']],
            [['gym_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gym::className(), 'targetAttribute' => ['gym_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gym_id' => 'Gym ID',
            'board_id' => 'Board ID',
        ];
    }

    /**
     * Gets query for [[Board]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoard()
    {
        return $this->hasOne(Board::className(), ['id' => 'board_id'])->inverseOf('gymBoards');
    }

    /**
     * Gets query for [[Gym]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGym()
    {
        return $this->hasOne(Gym::className(), ['id' => 'gym_id'])->inverseOf('gymBoards');
    }
}
