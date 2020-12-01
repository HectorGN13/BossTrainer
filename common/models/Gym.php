<?php

namespace common\models;

use app\models\UserGym;
use Yii;

/**
 * This is the model class for table "gym".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $verification_token
 *
 * @property UserGym[] $userGyms
 * @property User[] $users
 */
class Gym extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gym}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'email', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'provincia_id', 'postal_code'], 'default', 'value' => null],
            [['status', 'provincia_id', 'postal_code'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 320],
            [['email'], 'unique'],
            [['name'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::class, 'targetAttribute' => ['provincia_id' => 'id']],
            [['localidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => localidades::class, 'targetAttribute' => ['localidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'provincia_id' => 'Provincia ID',
            'postal_code' => 'Código postal',
            'description' => 'Descripción',
            'localidad_id' => 'Localidad ID',
        ];
    }

    /**
     * Gets query for [[UserGyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserGyms()
    {
        return $this->hasMany(UserGym::class, ['gym_id' => 'id'])->inverseOf('gym');;
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_gym', ['gym_id' => 'id']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::class, ['id' => 'provincia_id'])->inverseOf('gyms');
    }

    /**
     * Gets query for [[Localidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad()
    {
        return $this->hasOne(Localidades::className(), ['id' => 'localidad_id'])->inverseOf('gyms');
    }
}
