<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "weight".
 *
 * @property int $id
 * @property int $user_id
 * @property int $value
 * @property int $create_at
 *
 * @property User $user
 */
class Weight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'value', 'create_at'], 'required'],
            [['user_id', 'value', 'create_at'], 'default', 'value' => null],
            [['user_id', 'value', 'create_at'], 'integer'],
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
            'value' => 'Value',
            'create_at' => 'Create At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('weights');
    }
}
