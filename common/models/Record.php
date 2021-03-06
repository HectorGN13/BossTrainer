<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "record".
 *
 * @property int $user_id
 * @property int $movements_id
 * @property string|null $value
 *
 * @property Movements $movements
 * @property User $user
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'movements_id'], 'required'],
            [['user_id', 'movements_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['user_id', 'movements_id'], 'unique', 'targetAttribute' => ['user_id', 'movements_id']],
            [['movements_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movements::className(), 'targetAttribute' => ['movements_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['value'], 'match', 'pattern' => '#(^([0-9]|[1-9][0-9]|[1-9][0-9][0-9]):([0-5][0-9])$)|(^([0-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9])$)#'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Usuario ID',
            'movements_id' => 'Movimientos ID',
            'value' => 'Valor',
        ];
    }

    /**
     * Gets query for [[Movements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovements()
    {
        return $this->hasOne(Movements::className(), ['id' => 'movements_id'])->inverseOf('records');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('records');
    }

    public function beforeSave($insert)
    {
        $query = Movements::find()
            ->select('title')
            ->where([ 'id' => $this->movements_id])
            ->scalar();
        $notification = new Notification();
        $notification->recipient = Yii::$app->user->id;
        $notification->title = "¡Felicitaciones!";
        $notification->body = "Enhorabuena, has batido un nuevo record en " . $query . ".";

        $notification->save();

        return parent::beforeSave($insert);
    }
}
