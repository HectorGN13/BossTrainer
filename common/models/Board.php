<?php

namespace common\models;

use common\models\Gym;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "board".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int|null $created_by
 *
 * @property Gym $createdBy
 */
class Board extends ActiveRecord
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
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Gym::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Título',
            'body' => 'Contenido',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Gym::className(), ['id' => 'created_by'])->inverseOf('boards');
    }

    /**
     * Gets query for [[Gyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGymDefault()
    {
        return $this->hasOne(Gym::className(), ['default_board' => 'id'])->inverseOf('defaultBoard');
    }
}
