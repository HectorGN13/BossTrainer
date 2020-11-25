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
            [['status', 'id_provincia', 'postal_code'], 'default', 'value' => null],
            [['status', 'id_provincia', 'postal_code'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 320],
            [['email'], 'unique'],
            [['name'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['id_provincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::class, 'targetAttribute' => ['id_provincia' => 'id']],
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
            'id_provincia' => 'Id Provincia',
            'postal_code' => 'Código postal',
            'description' => 'Descripción',
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
        return $this->hasOne(Provincias::class, ['id' => 'id_provincia'])->inverseOf('gyms');
    }
}
