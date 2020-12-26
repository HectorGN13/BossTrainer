<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int $recipient
 * @property string $title
 * @property string $body
 * @property int $read
 * @property string $created_at
 *
 * @property User $recipient0
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipient', 'title', 'body', 'read', 'created_at'], 'required'],
            [['recipient', 'read'], 'default', 'value' => null],
            [['recipient', 'read'], 'integer'],
            [['body'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['recipient'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipient' => 'Recipient',
            'title' => 'Title',
            'body' => 'Body',
            'read' => 'Read',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Recipient0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient0()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient'])->inverseOf('notifications');
    }
}
